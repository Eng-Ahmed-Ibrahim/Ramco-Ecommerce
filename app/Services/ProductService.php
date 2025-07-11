<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Repositories\ProductsRepository;

class ProductService
{
    private $ProductsRepository;

    public function __construct(ProductsRepository $ProductsRepository)
    {
        $this->ProductsRepository = $ProductsRepository;
    }

    public function getProducts($filters = [])
    {

        $products = $this->ProductsRepository->getProducts($filters);
        return $products;
    }

    public function findProduct($slug)
    {
        $product = $this->ProductsRepository->show($slug);
        return $product;
    }

    public function add_product($data, $galleryFiles = [])
    {
        $thumbnailPath = null;

        try {
            return DB::transaction(function () use (&$thumbnailPath, $data, $galleryFiles) {
                $thumbnailPath = $data['thumbnail']->store('products/thumbnail', 'public');
                $data['thumbnail'] = $thumbnailPath;
                $data['colors'] = $this->formatColors($data['colors']);
                $product = $this->ProductsRepository->store($data);
                $this->upload_galleries($galleryFiles, $product);
                return $product;
            });
        } catch (\Exception $e) {
            // @phpstan-ignore-next-line
            if (!empty($thumbnailPath)  && Storage::disk('public')->exists($thumbnailPath)) {
                Storage::disk('public')->delete($thumbnailPath);
            }

            throw $e;
        }
    }

    public function update_product($data, $product_id, $galleryFiles = [])
    {
        $thumbnailPath = null;
        try {

            return DB::transaction(function () use (&$thumbnailPath, $data, $galleryFiles, $product_id) {
                if($data['thumbnail']){   
                    $thumbnailPath = $data['thumbnail']->store('products/thumbnail', 'public');
                    $data['thumbnail'] = $thumbnailPath;
                }

                $data['colors'] = $this->formatColors($data['colors']);
                $product = $this->ProductsRepository->update($product_id, $data);
                $this->upload_galleries($galleryFiles, $product);
                return $product;
            });
        } catch (\Exception $e) {

            // @phpstan-ignore-next-line
            if (!empty($thumbnailPath)  && Storage::disk('public')->exists($thumbnailPath))
                Storage::disk('public')->delete($thumbnailPath);
            throw $e;
        }
    }
    public function delete_product($id)
    {
        return  $this->ProductsRepository->destroy($id);
    }

    private function formatColors($colors)
    {
        $formated_colors = collect(json_decode($colors))
            ->pluck('value')
            ->filter()
            ->values()
            ->toArray();
        return $formated_colors;
    }

    private function upload_galleries($galleryFiles, $product)
    {
        foreach ($galleryFiles as $galleryFile) {
            $path = $galleryFile->store('products/gallery', 'public');
            $product->galleries()->create([
                'image' => $path,
            ]);
        }
    }
}
