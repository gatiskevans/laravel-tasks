<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TasksControllerTest extends TestCase
{
    use RefreshDatabase;
    //Every time test is run it will drop the database and commit migrations

    public function test_can_visit_tasks_page(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('tasks.index'));
        $response->assertStatus(200);
        $response->assertViewIs('tasks.index');
        $response->assertViewHas(['tasks']);    //checks if the specified variable is passed to the view
    }

    public function test_can_visit_create_page(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('tasks.create'));
        $response->assertStatus(200);
        $response->assertViewIs('tasks.create');
    }

    public function test_can_visit_edit_page(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = Task::factory()->create();

        $response = $this->get(route('tasks.edit', ['task' => $task]));
        $response->assertStatus(200);
        $response->assertViewIs('tasks.edit');
        $response->assertViewHas(['task']);
    }

    public function test_can_edit_task(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = Task::factory()->create();
        $this->followingRedirects();    //tells test the method will return redirect, to avoid 302 redirect error

        $response = $this->put(route('tasks.update', ['task' => $task]));
        $response->assertStatus(200);
    }

    public function test_can_store_task(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = Task::factory()->create();
        $this->followingRedirects();

        $response = $this->post(route('tasks.store', ['task' => $task]));
        $response->assertStatus(200);
    }

    public function test_can_delete_task(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = Task::factory()->create();
        $this->followingRedirects();

        $response = $this->delete(route('tasks.destroy', ['task' => $task]));
        $response->assertStatus(200);
        $this->assertDeleted('tasks', [
            'id' => $task->id
        ]);
    }

    public function test_completed_at_status(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = Task::factory()->create([
            'user_id' => $user->id
        ]);
        $this->followingRedirects();

        $response = $this->post(route('tasks.complete', ['task' => $task]));
        $response->assertStatus(200);
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'completed_at' => now()
        ]);
    }
}
