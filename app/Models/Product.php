<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{

    /**
     * PRODUCT ATTRIBUTES
     * $this->attributes['id'] - int - contains the product primary key (id)
     * $this->attributes['name'] - string - contains the product name
     * $this->attributes['description'] - string - contains the product description
     * $this->attributes['image'] - string - contains the product image
     * $this->attributes['price'] - int - contains the product price
     * $this->attributes['warranty'] - int - contains the product warranty period
     * RELATIONS
     * $this->itemsProduct - ItemProduct[] - contains the associated items
     */
    
    public static function validate($request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'image' => 'image',
            'price' => 'required|numeric|gt:0',
            'warranty' => 'required|numeric|gt:0',
        ]);
    }

    public static function sumPricesByQuantities($products, $productsInSession): int
    {
        $total = 0;
        foreach ($products as $product) {
            $total += $product->getPrice() * $productsInSession[$product->getId()];
        }

        return $total;
    }

    protected $fillable = ['name', 'description', 'image', 'price', 'warranty'];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function getDescription(): string
    {
        return $this->attributes['description'];
    }

    public function setDescription(string $description): void
    {
        $this->attributes['description'] = $description;
    }

    public function getImage(): string
    {
        return $this->attributes['image'];
    }

    public function setImage(string $image): void
    {
        $this->attributes['image'] = $image;
    }

    public function getPrice(): int
    {
        return $this->attributes['price'];
    }

    public function setPrice(int $price): void
    {
        $this->attributes['price'] = $price;
    }

    public function getWarranty(): int
    {
        return $this->attributes['warranty'];
    }

    public function setWarranty(int $warranty): void
    {
        $this->attributes['warranty'] = $warranty;
    }

    public function itemsProduct(): HasMany
    {
        return $this->hasMany(ItemProduct::class);
    }

    public function getItemsProduct()
    {
        return $this->itemsProduct()->get();
    }

    public function setItemsProduct($itemsProduct): void
    {
        $this->itemsProduct = $itemsProduct;
    }
}