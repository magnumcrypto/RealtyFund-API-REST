<?php

namespace App\DataFixtures;

use App\Entity\Exits;
use App\Entity\Investments;
use App\Entity\RentProperty;
use App\Entity\SaleProperty;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //Tabla y datos de 'user' para inversores
        $usersData = [
            ['nombre' => 'Juan', 'apellidos' => 'Pérez', 'direccion' => 'Calle Falsa 123', 'email' => 'juan@example.com', 'telefono' => '123456789', 'capitalAportado' => 20000.00, 'edad' => 30],
            ['nombre' => 'María', 'apellidos' => 'González', 'direccion' => 'Avenida Real 456', 'email' => 'maria@example.com', 'telefono' => '987654321', 'capitalAportado' => 20000.00, 'edad' => 35],
            ['nombre' => 'Pedro', 'apellidos' => 'Martínez', 'direccion' => 'Calle Principal 789', 'email' => 'pedro@example.com', 'telefono' => '456789123', 'capitalAportado' => 18000.00, 'edad' => 28],
            ['nombre' => 'Laura', 'apellidos' => 'López', 'direccion' => 'Plaza Mayor 10', 'email' => 'laura@example.com', 'telefono' => '369258147', 'capitalAportado' => 22000.00, 'edad' => 40],
            ['nombre' => 'Carlos', 'apellidos' => 'Sánchez', 'direccion' => 'Avenida Central 15', 'email' => 'carlos@example.com', 'telefono' => '147258369', 'capitalAportado' => 19000.00, 'edad' => 33],
            ['nombre' => 'Ana', 'apellidos' => 'Rodríguez', 'direccion' => 'Callejón Secreto 7', 'email' => 'ana@example.com', 'telefono' => '258369147', 'capitalAportado' => 17000.00, 'edad' => 25],
            ['nombre' => 'Sofía', 'apellidos' => 'Fernández', 'direccion' => 'Camino del Bosque 20', 'email' => 'sofia@example.com', 'telefono' => '369147258', 'capitalAportado' => 21000.00, 'edad' => 38],
            ['nombre' => 'Diego', 'apellidos' => 'Hernández', 'direccion' => 'Paseo del Río 30', 'email' => 'diego@example.com', 'telefono' => '147369258', 'capitalAportado' => 23000.00, 'edad' => 45],
            ['nombre' => 'Elena', 'apellidos' => 'Díaz', 'direccion' => 'Calle del Sol 25', 'email' => 'elena@example.com', 'telefono' => '258147369', 'capitalAportado' => 20000.00, 'edad' => 31],
            ['nombre' => 'Javier', 'apellidos' => 'Gómez', 'direccion' => 'Calle de la Luna 5', 'email' => 'javier@example.com', 'telefono' => '369147852', 'capitalAportado' => 24000.00, 'edad' => 42],
            ['nombre' => 'Juan', 'apellidos' => 'Palomo Rubio', 'direccion' => 'Calle de la Piruleta', 'email' => 'juanpalomo@example.es', 'telefono' => '690690690', 'capitalAportado' => 5000.00, 'edad' => 25],
            ['nombre' => 'Diego', 'apellidos' => 'Buena Ventura', 'direccion' => 'C/ Avenida dle Sur, 16, 1B', 'email' => 'dibuve@ejemplo.com', 'telefono' => '660660660', 'capitalAportado' => 16000.00, 'edad' => null],
            ['nombre' => 'Georgi', 'apellidos' => 'Vankov', 'direccion' => 'C/ Wall Street', 'email' => 'crack@hotmai.com', 'telefono' => '990990990', 'capitalAportado' => 15000.00, 'edad' => null],
            ['nombre' => 'Georgi', 'apellidos' => 'Vankov', 'direccion' => 'jsjssj', 'email' => 'ajajajajaj', 'telefono' => '11111111111', 'capitalAportado' => 12000.00, 'edad' => null],
            ['nombre' => 'Gonzalo', 'apellidos' => 'Waxete', 'direccion' => 'C/ Cecotec', 'email' => 'waxin@waxin.es', 'telefono' => '090080070', 'capitalAportado' => 20000.00, 'edad' => null],
            ['nombre' => 'Caramelo', 'apellidos' => 'De Chocolate', 'direccion' => 'C/ Chocolate', 'email' => 'choco@chococrack.com', 'telefono' => '222222222', 'capitalAportado' => 10000.00, 'edad' => null],
        ];
        foreach ($usersData as $userData) {
            $user = new User();
            $user->setNombre($userData['nombre']);
            $user->setApellidos($userData['apellidos']);
            $user->setDireccion($userData['direccion']);
            $user->setEmail($userData['email']);
            $user->setTelefono($userData['telefono']);
            $user->setCapitalAportado($userData['capitalAportado']);
            $user->setEdad($userData['edad']);

            $manager->persist($user);
        }

        //Tabla y datos de rent_property
        $rentPropertiesData = [
            ['tipoInmueble' => 'Apartamento', 'precio' => 1200.00, 'direccion' => 'Calle del Mar 123', 'descripcion' => 'Apartamento amueblado con vistas al mar', 'informacionDetallada' => 'Apartamento completamente amueblado ubicado en primera línea de playa. Consta de dos dormitorios, un baño, cocina americana y salón con vistas panorámicas al mar.', 'zona' => 'Zona costera', 'disponibilidad' => true, 'imagen' => 'imagen1.jpg'],
            ['tipoInmueble' => 'Piso', 'precio' => 800.00, 'direccion' => 'Avenida Principal 456', 'descripcion' => 'Piso luminoso en el centro de la ciudad', 'informacionDetallada' => 'Piso luminoso situado en una ubicación céntrica. La propiedad dispone de tres dormitorios, dos baños, cocina independiente, salón-comedor y balcón.', 'zona' => 'Centro urbano', 'disponibilidad' => true, 'imagen' => 'imagen2.jpg'],
            ['tipoInmueble' => 'Casa adosada', 'precio' => 1500.00, 'direccion' => 'Calle del Parque 789', 'descripcion' => 'Casa adosada con jardín y piscina comunitaria', 'informacionDetallada' => 'Casa adosada con jardín privado y acceso a piscina comunitaria. Consta de cuatro dormitorios, tres baños, cocina equipada, salón con chimenea y terraza.', 'zona' => 'Zona residencial', 'disponibilidad' => true, 'imagen' => 'imagen3.jpg'],
            ['tipoInmueble' => 'Ático', 'precio' => 2000.00, 'direccion' => 'Avenida del Puerto 10', 'descripcion' => 'Ático moderno con terraza y vistas panorámicas', 'informacionDetallada' => 'Ático moderno con terraza privada y vistas panorámicas. Consta de tres dormitorios, dos baños, cocina americana y amplio salón-comedor.', 'zona' => 'Zona céntrica', 'disponibilidad' => true, 'imagen' => 'imagen4.jpg'],
            ['tipoInmueble' => 'Chalet', 'precio' => 2500.00, 'direccion' => 'Calle de la Montaña 15', 'descripcion' => 'Chalet de lujo con piscina privada', 'informacionDetallada' => 'Chalet de lujo con piscina privada y jardín. La propiedad ofrece cinco dormitorios, cuatro baños, cocina totalmente equipada, sala de cine y zona de barbacoa.', 'zona' => 'Zona exclusiva', 'disponibilidad' => true, 'imagen' => 'imagen5.jpg'],
            ['tipoInmueble' => 'Casa rural', 'precio' => 1800.00, 'direccion' => 'Camino de la Acequia 20', 'descripcion' => 'Casa rural con encanto en entorno natural', 'informacionDetallada' => 'Casa rural con encanto situada en un entorno natural. La propiedad dispone de tres dormitorios, dos baños, cocina rústica, salón con chimenea y terraza con vistas a la montaña.', 'zona' => 'Entorno rural', 'disponibilidad' => true, 'imagen' => 'imagen6.jpg'],
            ['tipoInmueble' => 'Dúplex', 'precio' => 1000.00, 'direccion' => 'Plaza Mayor 25', 'descripcion' => 'Dúplex con terraza en el casco antiguo', 'informacionDetallada' => 'Dúplex con encanto en el casco antiguo de la ciudad. Consta de dos dormitorios, un baño, cocina americana, amplio salón-comedor y terraza con vistas a la plaza.', 'zona' => 'Centro histórico', 'disponibilidad' => true, 'imagen' => 'imagen7.jpg'],
            ['tipoInmueble' => 'Oficina', 'precio' => 1500.00, 'direccion' => 'Calle del Comercio 30', 'descripcion' => 'Oficina en edificio de oficinas', 'informacionDetallada' => 'Oficina situada en un edificio de oficinas en una ubicación estratégica. Espacio diáfano con zona de trabajo, sala de reuniones y baño privado.', 'zona' => 'Zona empresarial', 'disponibilidad' => true, 'imagen' => 'imagen8.jpg'],
            ['tipoInmueble' => 'Local comercial', 'precio' => 2000.00, 'direccion' => 'Avenida de la Libertad 35', 'descripcion' => 'Amplio local comercial en zona comercial', 'informacionDetallada' => 'Amplio local comercial ubicado en una zona muy transitada. Perfecto para cualquier tipo de negocio. Cuenta con espacio diáfano, almacén y baño.', 'zona' => 'Zona comercial', 'disponibilidad' => true, 'imagen' => 'imagen9.jpg'],
            ['tipoInmueble' => 'Casa de campo', 'precio' => 2200.00, 'direccion' => 'Carretera de la Sierra 40', 'descripcion' => 'Casa de campo con piscina y jardín', 'informacionDetallada' => 'Casa de campo con piscina y amplio jardín. La propiedad ofrece cuatro dormitorios, tres baños, cocina equipada, salón con chimenea y zona de barbacoa.', 'zona' => 'Entorno rural', 'disponibilidad' => true, 'imagen' => 'imagen10.jpg']
        ];
        foreach ($rentPropertiesData as $data) {
            $rentProperty = new RentProperty();
            $rentProperty->setTipoInmueble($data['tipoInmueble']);
            $rentProperty->setPrecio($data['precio']);
            $rentProperty->setDireccion($data['direccion']);
            $rentProperty->setDescripcion($data['descripcion']);
            $rentProperty->setInformacionDetallada($data['informacionDetallada']);
            $rentProperty->setZona($data['zona']);
            $rentProperty->setDisponibilidad($data['disponibilidad']);
            $rentProperty->setImagen($data['imagen']);

            $manager->persist($rentProperty);
        }

        //Tabla y datos de sale_property
        $salesPropertiesData = [
            ['tipo_inmueble' => 'Casa', 'precio' => 250000.00, 'direccion' => 'Calle del Sol 123', 'descripcion' => 'Bonita casa de dos plantas', 'informacion_detallada' => 'Casa de dos plantas ubicada en una zona residencial tranquila. La casa cuenta con tres dormitorios, dos baños, cocina equipada, sala de estar y jardín trasero.', 'zona' => 'Zona residencial', 'disponibilidad' => 1, 'imagen' => 'imagen1.jpg'],
            ['tipo_inmueble' => 'Apartamento', 'precio' => 150000.00, 'direccion' => 'Avenida Principal 456', 'descripcion' => 'Apartamento moderno con vistas al mar', 'informacion_detallada' => 'Moderno apartamento ubicado en un edificio con vistas al mar. Consta de dos dormitorios, un baño, cocina abierta y sala de estar. Dispone de piscina comunitaria y aparcamiento.', 'zona' => 'Zona costera', 'disponibilidad' => 0, 'imagen' => 'imagen2.jpg'],
            ['tipo_inmueble' => 'Chalet', 'precio' => 350000.00, 'direccion' => 'Calle de la Luna 789', 'descripcion' => 'Amplio chalet con piscina privada', 'informacion_detallada' => 'Espacioso chalet de lujo con piscina privada y jardín. La propiedad cuenta con cuatro dormitorios, tres baños, cocina totalmente equipada, sala de cine y zona de barbacoa. Ideal para familias.', 'zona' => 'Zona exclusiva', 'disponibilidad' => 0, 'imagen' => 'imagen3.jpg'],
            ['tipo_inmueble' => 'Piso', 'precio' => 120000.00, 'direccion' => 'Calle Mayor 10', 'descripcion' => 'Acogedor piso en el centro de la ciudad', 'informacion_detallada' => 'Piso luminoso ubicado en el corazón de la ciudad. Dispone de dos dormitorios, un baño, cocina independiente y sala de estar. Cerca de tiendas, restaurantes y transporte público.', 'zona' => 'Centro urbano', 'disponibilidad' => 0, 'imagen' => 'imagen4.jpg'],
            ['tipo_inmueble' => 'Casa adosada', 'precio' => 180000.00, 'direccion' => 'Avenida del Parque 15', 'descripcion' => 'Encantadora casa adosada con jardín', 'informacion_detallada' => 'Casa adosada con encanto en una comunidad tranquila. La propiedad cuenta con tres dormitorios, dos baños, cocina equipada, salón-comedor y terraza con jardín.', 'zona' => 'Entorno natural', 'disponibilidad' => 0, 'imagen' => 'imagen5.jpg'],
            ['tipo_inmueble' => 'Ático', 'precio' => 200000.00, 'direccion' => 'Calle del Mar 20', 'descripcion' => 'Ático con terraza panorámica', 'informacion_detallada' => 'Luminoso ático situado en un edificio moderno. Consta de dos dormitorios, dos baños, cocina americana y amplia terraza con vistas panorámicas a la ciudad.', 'zona' => 'Zona céntrica', 'disponibilidad' => 0, 'imagen' => 'imagen6.jpg'],
            ['tipo_inmueble' => 'Finca rústica', 'precio' => 300000.00, 'direccion' => 'Camino del Monte 25', 'descripcion' => 'Finca rústica con vistas a la montaña', 'informacion_detallada' => 'Encantadora finca rústica enclavada en un entorno natural. La propiedad incluye una casa de campo con tres dormitorios, dos baños, cocina rústica, salón con chimenea y terreno con árboles frutales.', 'zona' => 'Entorno rural', 'disponibilidad' => 1, 'imagen' => 'imagen7.jpg'],
            ['tipo_inmueble' => 'Dúplex', 'precio' => 160000.00, 'direccion' => 'Plaza del Parque 30', 'descripcion' => 'Dúplex con terraza y garaje', 'informacion_detallada' => 'Moderno dúplex con terraza y garaje privado. Dispone de tres dormitorios, dos baños, cocina independiente, amplio salón-comedor y terraza con vistas despejadas.', 'zona' => 'Zona residencial', 'disponibilidad' => 1, 'imagen' => 'imagen8.jpg'],
            ['tipo_inmueble' => 'Local comercial', 'precio' => 180000.00, 'direccion' => 'Avenida de la Libertad 35', 'descripcion' => 'Amplio local comercial en zona comercial', 'informacion_detallada' => 'Local comercial de gran tamaño ubicado en una zona muy transitada. Ideal para cualquier tipo de negocio. Cuenta con espacio diáfano, almacén y baño.', 'zona' => 'Zona comercial', 'disponibilidad' => 1, 'imagen' => 'imagen9.jpg'],
            ['tipo_inmueble' => 'Casa de campo', 'precio' => 280000.00, 'direccion' => 'Carretera Vieja 40', 'descripcion' => 'Casa de campo con piscina y jardín', 'informacion_detallada' => 'Encantadora casa de campo con piscina y amplio jardín. La propiedad ofrece cuatro dormitorios, tres baños, cocina equipada, salón con chimenea y zona de barbacoa.', 'zona' => 'Entorno rural', 'disponibilidad' => 1, 'imagen' =>    'imagen10.jpg'],
            ['tipo_inmueble' => 'Oficina', 'precio' => 200000.00, 'direccion' => 'Calle del Centro 45', 'descripcion' => 'Oficina en edificio de oficinas', 'informacion_detallada' => 'Oficina situada en un edificio de oficinas en el centro de la ciudad. Espacio diáfano con luz natural, zona de reuniones y baño privado.', 'zona' => 'Centro urbano', 'disponibilidad' => 1, 'imagen' => 'imagen11.jpg'],
            ['tipo_inmueble' => 'Nave industrial', 'precio' => 250000.00, 'direccion' => 'Polígono Industrial 50', 'descripcion' => 'Nave industrial con acceso para camiones', 'informacion_detallada' => 'Amplia nave industrial con acceso para camiones. Espacio diáfano con oficina, baño y zona de almacenaje. Ideal para actividades industriales o de almacenaje.', 'zona' => 'Polígono industrial', 'disponibilidad' => 1, 'imagen' => 'imagen12.jpg'],
            ['tipo_inmueble' => 'Casa rural', 'precio' => 220000.00, 'direccion' => 'Camino de la Sierra 55', 'descripcion' => 'Casa rural con piscina y vistas panorámicas', 'informacion_detallada' => 'Acogedora casa rural con piscina y vistas panorámicas a la montaña. La propiedad consta de tres dormitorios, dos baños, cocina rústica, salón con chimenea y terraza cubierta.', 'zona' => 'Entorno natural', 'disponibilidad' => 1, 'imagen' => 'imagen13.jpg'],
            ['tipo_inmueble' => 'Local comercial', 'precio' => 160000.00, 'direccion' => 'Avenida del Mar 60', 'descripcion' => 'Local comercial en zona turística', 'informacion_detallada' => 'Local comercial ubicado en una zona turística con gran afluencia de visitantes. Perfecto para cualquier tipo de negocio. Dispone de espacio diáfano y amplio escaparate.', 'zona' => 'Zona turística', 'disponibilidad' => 1, 'imagen' => 'imagen14.jpg'],
            ['tipo_inmueble' => 'Terreno', 'precio' => 100000.00, 'direccion' => 'Carretera Nueva 65', 'descripcion' => 'Terreno urbanizable con vistas al mar', 'informacion_detallada' => 'Terreno urbanizable con vistas al mar y posibilidad de construcción. Ideal para promotores o inversores. Superficie plana y acceso a servicios.', 'zona' => 'Zona costera', 'disponibilidad' => 1, 'imagen' => 'imagen15.jpg'],
            ['tipo_inmueble' => 'Local comercial', 'precio' => 170000.00, 'direccion' => 'Avenida del Sol 70', 'descripcion' => 'Amplio local comercial en esquina', 'informacion_detallada' => 'Amplio local comercial situado en una esquina con gran visibilidad. Espacio diáfano con escaparate, almacén y baño. Perfecto para todo tipo de negocios.', 'zona' => 'Zona comercial', 'disponibilidad' => 1, 'imagen' => 'imagen16.jpg'],
            ['tipo_inmueble' => 'Casa de pueblo', 'precio' => 140000.00, 'direccion' => 'Calle del Campo 75', 'descripcion' => 'Casa de pueblo con patio interior', 'informacion_detallada' => 'Encantadora casa de pueblo con patio interior. La propiedad cuenta con tres dormitorios, dos baños, cocina independiente, sala de estar y patio privado.', 'zona' => 'Centro histórico', 'disponibilidad' => 1, 'imagen' => 'imagen17.jpg'],
            ['tipo_inmueble' => 'Apartamento', 'precio' => 180000.00, 'direccion' => 'Paseo Marítimo 80', 'descripcion' => 'Apartamento con vistas al mar', 'informacion_detallada' => 'Apartamento con vistas al mar en primera línea de playa. Consta de dos dormitorios, un baño, cocina americana y terraza con vistas panorámicas.', 'zona' => 'Zona costera', 'disponibilidad' => 1, 'imagen' => 'imagen18.jpg'],
            ['tipo_inmueble' => 'Casa unifamiliar', 'precio' => 300000.00, 'direccion' => 'Calle del Parque 85', 'descripcion' => 'Casa unifamiliar con jardín y piscina', 'informacion_detallada' => 'Amplia casa unifamiliar con jardín y piscina privada. La propiedad ofrece cuatro dormitorios, tres baños, cocina equipada, salón-comedor y garaje para dos coches.', 'zona' => 'Zona residencial', 'disponibilidad' => 1, 'imagen' => 'imagen19.jpg'],
            ['tipo_inmueble' => 'Local comercial', 'precio' => 190000.00, 'direccion' => 'Avenida de la Paz 90', 'descripcion' => 'Local comercial en esquina con terraza', 'informacion_detallada' => 'Local comercial en esquina con terraza privada. Espacio diáfano con amplio escaparate, almacén, baño y terraza exterior. Ideal para hostelería u otros negocios.', 'zona' => 'Zona comercial', 'disponibilidad' => 1, 'imagen' => 'imagen20.jpg']
        ];
        foreach ($salesPropertiesData as $data) {
            $saleProperty = new SaleProperty();
            $saleProperty->setTipoInmueble($data['tipo_inmueble']);
            $saleProperty->setPrecio($data['precio']);
            $saleProperty->setDireccion($data['direccion']);
            $saleProperty->setDescripcion($data['descripcion']);
            $saleProperty->setInformacionDetallada($data['informacion_detallada']);
            $saleProperty->setZona($data['zona']);
            $saleProperty->setDisponibilidad($data['disponibilidad']);
            $saleProperty->setImagen($data['imagen']);

            $manager->persist($saleProperty);
            $saleProperties[] = $saleProperty;
        }

        //Tabla y datos de exits
        $exitsData = [
            ['precio_compra' => 250000.00, 'precio_venta' => 280000.00, 'porcentaje_rentabilidad' => 12.00],
            ['precio_compra' => 150000.00, 'precio_venta' => 180000.00, 'porcentaje_rentabilidad' => 20.00],
            ['precio_compra' => 350000.00, 'precio_venta' => 410000.00, 'porcentaje_rentabilidad' => 17.15],
            ['precio_compra' => 120000.00, 'precio_venta' => 140000.00, 'porcentaje_rentabilidad' => 16.67],
            ['precio_compra' => 180000.00, 'precio_venta' => 220000.00, 'porcentaje_rentabilidad' => 22.22],
            ['precio_compra' => 200000.00, 'precio_venta' => 214000.00, 'porcentaje_rentabilidad' => 7.00]
        ];
        foreach ($exitsData as $key => $data) {
            $exit = new Exits();
            $exit->setSaleProperty($saleProperties[$key]);
            $exit->setPrecioCompra($data['precio_compra']);
            $exit->setPrecioVenta($data['precio_venta']);
            $exit->setRentabilidad($data['porcentaje_rentabilidad']);

            $manager->persist($exit);
        }

        $manager->flush();
    }
}
