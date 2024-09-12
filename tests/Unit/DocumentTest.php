<?php

namespace Tests\Unit;

use App\Models\Document;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class DocumentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Category::create(['name' => 'Remessa']);
        Category::create(['name' => 'Remessa Parcial']);
    }

    public function test_contents_exceeds_maximum_length()
    {
        $this->expectException(ValidationException::class);

        Document::create([
            'category_id' => 1,
            'title' => 'Título do documento',
            'contents' => str_repeat('a', 5001),
        ]);
    }

    public function test_contents_within_maximum_length()
    {
        $document = Document::create([
            'category_id' => 1,
            'title' => 'Título do documento semestre',
            'contents' => str_repeat('a', 5000),
        ]);

        $this->assertNotNull($document);
    }

    public function test_remessa_title_must_contain_semestre()
    {
        $this->expectException(ValidationException::class);

        Document::create([
            'category_id' => 1,
            'title' => 'Título inválido',
            'contents' => 'Conteúdo válido',
        ]);
    }

    public function test_remessa_partial_title_must_contain_month()
    {
        $this->expectException(ValidationException::class);

        Document::create([
            'category_id' => 2,
            'title' => 'Título inválido',
            'contents' => 'Conteúdo válido',
        ]);
    }

    public function test_remessa_partial_with_valid_month_in_title()
    {
        $document = Document::create([
            'category_id' => 2,
            'title' => 'Título de Janeiro',
            'contents' => 'Conteúdo válido',
        ]);

        $this->assertNotNull($document);
    }
}
