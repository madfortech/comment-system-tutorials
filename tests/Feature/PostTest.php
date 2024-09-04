<?php


test('display all posts index', function () {
    $response = $this->get('/posts/index');
    $response->assertStatus(200);
});