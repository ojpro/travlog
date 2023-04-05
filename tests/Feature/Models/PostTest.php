<?php

// test the creation of new blog posts using factory
test("can create blog posts using factory", function () {
    // generate a post using factory
    $post = \App\Models\Post::factory()->create();

    // check the database
    $this->assertDatabaseHas('posts', $post->toArray());
    $this->assertDatabaseCount('posts',1);
});

// create new blog post
it("create new blog post", function () {
    // a dummy post attributes
    $post = [
        "title" => "Post Title",
        "thumbnail_url" => "https://source.unsplash.com/random/",
        "tags" => "post, test",
        "content" => "this is a sample post content for testing the api",
    ];

    // send create request
    $response = $this->post(route('blog.store'), $post);

    // assert create response status
    $response->assertCreated();

    // post added to the database
    $this->assertDatabaseCount('posts', 1);
    $this->assertDatabaseHas('posts', $post);
});

// get all the added posts
it("fetch all the blog posts", function () {
    // create dummy posts
    $posts = \App\Models\Post::factory()->count(2)->create();

    // assert that the posts added
    $this->assertDatabaseCount('posts', 2);

    // fetch all the posts
    $response = $this->json('get', route('blog.index'));

    // check if the response is same as the created posts
    $response->assertJson($posts->toArray());
});

// fetch a post
it("fetch a specific post", function () {
    // create dummy posts
    $posts = \App\Models\Post::factory()->count(2)->create();

    // fetch second post by it ID
    $response = $this->getJson(route('blog.show', $posts[0]['id']));

    // assert the response Ok and same as the wanted post
    $response->assertOk()
        ->assertJson($posts[0]->toArray());
});

// update post information

it('update the post data', function () {
    // dummy post
    $post = \App\Models\Post::factory()->create();

    // new post data
    $new_post = \App\Models\Post::factory()->make()->toArray();

    // send update request
    $response = $this->put(route('blog.update', $post['id']), $new_post);

    // assert response success
    $response->assertOk();

    // assert post data update
    $this->assertDatabaseHas('posts', $new_post);
});

// delete a post
it('delete blog posts', function () {
    // create a temp post
    $post = \App\Models\Post::factory()->create();

    // send delete request
    $response = $this->delete(route('blog.destroy', $post['id']));

    // assert success response
    $response->assertOk();

    // check the database
    $this->assertDatabaseMissing('posts', $post->toArray());
    $this->assertDatabaseCount('posts', 0);

});
