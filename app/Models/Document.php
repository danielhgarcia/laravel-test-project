<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'title', 'contents'];

    const MONTHS = [
        'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
        'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($document) {

            if (strlen($document->contents) > 5000) {
                throw ValidationException::withMessages(
                    ['contents' => 'O campo "conteúdo" não pode exceder 5000 caracteres.']
                );
            }

            if ($document->category->name === 'Remessa' && !str_contains($document->title, 'semestre')) {
                throw ValidationException::withMessages(
                    ['title' => 'O título deve conter a palavra "semestre" para a categoria "Remessa".']
                );
            }

            if (
                $document->category->name === 'Remessa Parcial' &&
                !self::titleContainsMonth($document->title)
            ) {
                throw ValidationException::withMessages(
                    ['title' => 'O título deve conter o nome de um mês para a categoria "Remessa Parcial".']
                );
            }
        });
    }

    protected static function titleContainsMonth($title)
    {
        $monthsPattern = implode('|', self::MONTHS);
        return preg_match("/$monthsPattern/", $title);
    }
}
