<?php

use App\Models\User;

test('short urls will redirect to long urls', function () {
    $user = User::factory()->create();

    $link = $user->links()->create([
        'url' => 'https://example.com/test-url',
    ]);

    $response = $this->get($link->short_url);

    $response->assertRedirect($link->url);
});

test('short urls visits will be tracked', function () {
    $user = User::factory()->create();

    $link = $user->links()->create([
        'url' => 'https://example.com/tracking-test',
    ]);

    $this->get($link->short_url);
    $this->get($link->short_url);

    $this->assertSame($link->refresh()->hits, 2);
});

test('single link can be created without errors', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->post(action(App\Http\Controllers\LinkCreate::class), [
            'url' => 'https://example.com/a-valid-url',
        ]);

    $response->assertSessionHasNoErrors();
    $this->assertTrue($user->links()->exists());
});

test('single link will return errors if URL is invalid', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->post(action(App\Http\Controllers\LinkCreate::class), [
            'url' => 'not-a-valid-url',
        ]);

    $response->assertSessionHasErrors();
    $this->assertFalse($user->links()->exists());
});

// @todo CSV Import Test
