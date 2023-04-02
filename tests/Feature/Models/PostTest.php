<?php

// test the creation of new blog posts
it("create blog posts", function () {
    $post = \App\Models\Post::factory()->create();

    $this->assertDatabaseHas('posts', $post->toArray());
});
