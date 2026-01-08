<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            ['name' => 'Parlante Bluetooth', 'price' => 20.0, 'image' => '/parlante.png', 'span' => 'md:col-span-2 md:row-span-2', 'category' => 'Audio'],
            ['name' => 'Audífonos Inalámbricos', 'price' => 45.0, 'image' => '/audifonos_1.png', 'span' => 'md:col-span-1 md:row-span-1', 'category' => 'Audio'],
            ['name' => 'Audífonos Inalámbricos Básicos', 'price' => 15.0, 'image' => '/audifonos_2.png', 'span' => 'md:col-span-1 md:row-span-1', 'category' => 'Audio'],
            ['name' => 'Audífonos con Micrófono', 'price' => 50.0, 'image' => '/audifonos_3.png', 'span' => 'md:col-span-1', 'category' => 'Audio'],
            ['name' => 'Audífonos Alámbricos', 'price' => 25.0, 'image' => '/audifonos_4.png', 'span' => 'md:col-span-1', 'category' => 'Audio'],
            ['name' => 'Micrófono para Streaming', 'price' => 12.0, 'image' => '/microfono.png', 'span' => 'md:col-span-1', 'category' => 'Accesorios'],
            ['name' => 'Control Remoto para TV', 'price' => 12.0, 'image' => '/control_tv.png', 'span' => 'md:col-span-1', 'category' => 'Accesorios'],
            ['name' => 'Cargador de Carga Rápida', 'price' => 10.0, 'image' => '/Cargadores de carga rápida.png', 'span' => 'md:col-span-1', 'category' => 'Cargadores'],
            ['name' => 'Cable Reforzado para iPhone', 'price' => 20.0, 'image' => '/Cables reforzados para iPhone.png', 'span' => 'md:col-span-1', 'category' => 'Cargadores'],
            ['name' => 'Cargador Super Rápido Certificado', 'price' => 25.0, 'image' => '/Cargadores carga super rápida  certificados.png', 'span' => 'md:col-span-1', 'category' => 'Cargadores'],
            ['name' => 'Cargador Rápido para Samsung', 'price' => 20.0, 'image' => '/Cargadores carga super rápida 2.0 para Samsung.png', 'span' => 'md:col-span-1', 'category' => 'Cargadores'],
            ['name' => 'Cargador para Tecno / Infinix', 'price' => 25.0, 'image' => '/cargador infinix.png', 'span' => 'md:col-span-1', 'category' => 'Cargadores'],
            ['name' => 'Cable Reforzado Tipo C', 'price' => 7.0, 'image' => '/Cables reforzados tipo-c.png', 'span' => 'md:col-span-1', 'category' => 'Cargadores'],
            ['name' => 'Audífonos AKG', 'price' => 12.0, 'image' => '/Audifonos AKG.png', 'span' => 'md:col-span-1', 'category' => 'Audio'],
            ['name' => 'Audífonos con Diseño Transformers', 'price' => 15.0, 'image' => '/Audífonos con diseño Transformers .png', 'span' => 'md:col-span-1', 'category' => 'Audio'],
            ['name' => 'Audífonos Tipo AirPods', 'price' => 35.0, 'image' => '/Airpods.png', 'span' => 'md:col-span-1', 'category' => 'Audio'],
            ['name' => 'Audífonos Open Ear', 'price' => 35.0, 'image' => '/Audífonos Open Ear.png', 'span' => 'md:col-span-1', 'category' => 'Audio'],
            ['name' => 'Cargador para Vehículo', 'price' => 20.0, 'image' => '/Cargadores para carro carga super rápida.png', 'span' => 'md:col-span-1', 'category' => 'Cargadores'],
            ['name' => 'Mouse Inalámbrico', 'price' => 7.0, 'image' => '/mouse.png', 'span' => 'md:col-span-1', 'category' => 'Tecnología'],
            ['name' => 'Teclado Alámbrico', 'price' => 10.0, 'image' => '/teclado con cable.png', 'span' => 'md:col-span-1', 'category' => 'Tecnología'],
        ];

        foreach ($products as $data) {
            $category = Category::firstOrCreate(['name' => $data['category']]);
            
            Product::create([
                'name' => $data['name'],
                'price' => $data['price'],
                'image' => $data['image'],
                'layout_span' => $data['span'],
                'category_id' => $category->id,
            ]);
        }
    }
}
