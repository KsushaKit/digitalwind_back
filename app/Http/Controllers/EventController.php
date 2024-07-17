<?php

namespace App\Http\Controllers;

use App\Models\event\Event;
use App\Models\event\Image;
use App\Models\event\Speaker;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{

    // Получает список всех мероприятий
    public function index(): JsonResponse
    {
        $events = Event::with(['speakers', 'images'])->get();
        return response()->json($events);
    }

    // Создание мероприятия
    public function store(Request $request)
    {
        $validated = $this->validateEventData($request);

        try {
            DB::beginTransaction();

            $eventData = $validated;
            unset($eventData['speakers'], $eventData['images']);
            $event = Event::create($eventData);

            $this->handleSpeakers($event, $validated['speakers'] ?? null);
            $this->handleImages($event, $request->file('images') ?? null);

            DB::commit();
            return response()->json($event->load(['speakers', 'images']), 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to create event.'], 500);
        }
    }

    // Изменение мероприятия
    public function update(Request $request, $id)
    {
        $validated = $this->validateEventData($request);

        try {
            DB::beginTransaction();

            $event = Event::findOrFail($id);

            $eventData = $validated;
            unset($eventData['speakers'], $eventData['images']);
            $event->update($eventData);

            $this->handleSpeakers($event, $validated['speakers'] ?? null);
            $this->handleImages($event, $request->file('images') ?? null);

            DB::commit();
            return response()->json($event->load(['speakers', 'images']));

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to update event.'], 500);
        }
    }

    // Регистрация на мероприятие
    public function register($id)
    {
        try {
            DB::beginTransaction();

            $event = Event::findOrFail($id);
            if ($event->current_members >= $event->max_members) {
                return response()->json(['message' => 'No more slots available.'], 400);
            }

            $event->increment('current_members');

            DB::commit();
            return response()->json(['message' => 'Registration successful.']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to register.'], 500);
        }
    }

    // Получение мероприятия по ID с связанными данными
    public function show($id)
    {
        $event = Event::with(['speakers', 'images'])->findOrFail($id);
        return response()->json($event);
    }

    // Удаление мероприятия с автоматическим удалением связанных данных
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        // Удаление связанных данных
        $event->speakers()->detach();
        $event->images()->delete();
        $event->delete();

        return response()->json(['message' => 'Мероприятие успешно удалено']);
    }

    // Метод для валидации данных
    private function validateEventData(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'location' => 'required|string|max:255',
            'target_audience' => 'required|string|max:255',
            'max_members' => 'required|integer|min:1',
            'current_members' => 'nullable|integer|min:0|lt:max_members',
            'speakers' => 'nullable|array',
            'speakers.*.name' => 'required_with:speakers|string|max:255',
            'speakers.*.position' => 'required_with:speakers|string|max:255',
            'images' => 'nullable|array',
            'images.*' => 'required_with:images|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }

    // Метод обработки спикеров
    private function handleSpeakers($event, $speakers)
    {
        if ($speakers) {
            $event->speakers()->detach();
            foreach ($speakers as $speakerData) {
                $speaker = Speaker::create($speakerData);
                $event->speakers()->attach($speaker);
            }
        }
    }

    // Метод обработки изображений
    private function handleImages($event, $images)
    {
        if ($images) {
            $event->images()->delete();
            foreach ($images as $image) {
                $imagePath = $image->store('events', 'public');
                Image::create([
                    'url' => $imagePath,
                    'event_id' => $event->id,
                ]);
            }
        }
    }

}
