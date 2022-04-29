<?php

namespace App\Models;
use App\Services\Scrapper;
class Product extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'url',
    ];

    /**
     * @return string[]
     */
    public function getWebData(): array
    {
        $scrapper = new Scrapper();
        $protucts = $scrapper->getResponse('https://github.com');
        return $protucts;
    }
}
