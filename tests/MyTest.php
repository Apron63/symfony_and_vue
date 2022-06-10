<?php
namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MyTest extends WebTestCase
{
    public function testSomething()
    {
        $client = static::createClient();

        // Добавим категорию.
        $crawler = $client->request(
            'POST',
            '/api/category/',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_X-Requested-With' => 'XMLHttpRequest'
            ],
            '{"name":"my_test"}'
        );
        $this->assertResponseIsSuccessful('Response error');

        $response = $client->getResponse();
        $content = json_decode($response->getContent());
        $id = $content->id;
        $this->assertIsInt($id, 'Response not int');

        // Список категорий.
        $crawler = $client->request('GET', '/api/categories/');
        $this->assertResponseIsSuccessful('Category list not responsed');

        // Категория по id.
        $crawler = $client->request('GET', '/api/category/' . $id . '/');
        $this->assertResponseIsSuccessful('Category by id not found');

        // Отредактируем категорию.
        $crawler = $client->request(
            'PUT',
            '/api/category/',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_X-Requested-With' => 'XMLHttpRequest'
            ],
            '{"id":' . $id . ', "name": "other_test"}'
        );
        $this->assertResponseIsSuccessful('Response error');

        // Удалим категорию.
        $crawler = $client->request(
            'DELETE',
            '/api/category/' . $id . '/'
        );
        $this->assertResponseIsSuccessful('Response error');

        // Проверим удаление.
        $crawler = $client->request('GET', '/api/category/' . $id . '/');
        $this->assertResponseStatusCodeSame(404, 'Invalid Response code ');

    }
}