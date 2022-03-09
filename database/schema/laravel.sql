/*
SQLyog Ultimate
MySQL - 5.7.24 : Database - laravel
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `banner` */

DROP TABLE IF EXISTS `banner`;

CREATE TABLE `banner` (
  `idbanner` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pagina` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitulo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contenido` text COLLATE utf8mb4_unicode_ci,
  `ruta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagen` text COLLATE utf8mb4_unicode_ci,
  `posicion` int(11) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idbanner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `banner` */

/*Table structure for table `banner_imagen` */

DROP TABLE IF EXISTS `banner_imagen`;

CREATE TABLE `banner_imagen` (
  `idbanner_imagen` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idbanner` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `posicion` int(11) NOT NULL DEFAULT '1',
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idbanner_imagen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `banner_imagen` */

/*Table structure for table `blog` */

DROP TABLE IF EXISTS `blog`;

CREATE TABLE `blog` (
  `idblog` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitulo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `autor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `contenido` text COLLATE utf8mb4_unicode_ci,
  `imagen` text COLLATE utf8mb4_unicode_ci,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idblog`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `blog` */

/*Table structure for table `categoria_has_producto` */

DROP TABLE IF EXISTS `categoria_has_producto`;

CREATE TABLE `categoria_has_producto` (
  `idcategoria_has_producto` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idcategoria` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  PRIMARY KEY (`idcategoria_has_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `categoria_has_producto` */

insert  into `categoria_has_producto`(`idcategoria_has_producto`,`idcategoria`,`idproducto`) values (1,1,1);
insert  into `categoria_has_producto`(`idcategoria_has_producto`,`idcategoria`,`idproducto`) values (2,2,1);

/*Table structure for table `categoria_producto` */

DROP TABLE IF EXISTS `categoria_producto`;

CREATE TABLE `categoria_producto` (
  `idcategoria_producto` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `imagen` text COLLATE utf8mb4_unicode_ci,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idcategoria_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `categoria_producto` */

insert  into `categoria_producto`(`idcategoria_producto`,`slug`,`nombre`,`descripcion`,`imagen`,`estado`) values (1,'c1','c1',NULL,NULL,1);
insert  into `categoria_producto`(`idcategoria_producto`,`slug`,`nombre`,`descripcion`,`imagen`,`estado`) values (2,'c2','c2',NULL,NULL,1);

/*Table structure for table `cliente` */

DROP TABLE IF EXISTS `cliente`;

CREATE TABLE `cliente` (
  `idcliente` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idtipo_documento_identidad` int(11) NOT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `nombres` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellidos` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero_documento_identidad` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sexo` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `iddepartamento` int(11) DEFAULT NULL,
  `idprovincia` int(11) DEFAULT NULL,
  `iddistrito` int(11) DEFAULT NULL,
  `direccion_linea1` text COLLATE utf8mb4_unicode_ci,
  `direccion_linea2` text COLLATE utf8mb4_unicode_ci,
  `referencia` text COLLATE utf8mb4_unicode_ci,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cliente` */

/*Table structure for table `contacto` */

DROP TABLE IF EXISTS `contacto`;

CREATE TABLE `contacto` (
  `idcontacto` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `correo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pinterest` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tiktok` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ubicacion` text COLLATE utf8mb4_unicode_ci,
  `direccion` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`idcontacto`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `contacto` */

insert  into `contacto`(`idcontacto`,`correo`,`telefono`,`telefono2`,`telefono3`,`whatsapp`,`facebook`,`twitter`,`instagram`,`pinterest`,`tiktok`,`youtube`,`linkedin`,`ubicacion`,`direccion`) values (1,'contacto@exaple.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `cupon` */

DROP TABLE IF EXISTS `cupon`;

CREATE TABLE `cupon` (
  `idcupon` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idtipo_descuento` int(11) NOT NULL,
  `idtipo_uso` int(11) NOT NULL,
  `nombre` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monto` decimal(11,2) NOT NULL,
  `fecha_desde` date NOT NULL,
  `fecha_hasta` date NOT NULL,
  `monto_minimo` decimal(11,2) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idcupon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cupon` */

/*Table structure for table `empresa` */

DROP TABLE IF EXISTS `empresa`;

CREATE TABLE `empresa` (
  `idempresa` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `titulo_general` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `favicon` text COLLATE utf8mb4_unicode_ci,
  `logo` text COLLATE utf8mb4_unicode_ci,
  `logo2` text COLLATE utf8mb4_unicode_ci,
  `seo_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seguimiento_head` text COLLATE utf8mb4_unicode_ci,
  `seguimiento_body` text COLLATE utf8mb4_unicode_ci,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idempresa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `empresa` */

insert  into `empresa`(`idempresa`,`titulo_general`,`nombre`,`descripcion`,`favicon`,`logo`,`logo2`,`seo_keywords`,`seo_description`,`seo_author`,`seguimiento_head`,`seguimiento_body`,`estado`) values (1,'empresa','empresa',NULL,'favicon-default.jpg','logo-default.jpg','logo-default2.jfif',NULL,NULL,NULL,NULL,NULL,1);

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `marca` */

DROP TABLE IF EXISTS `marca`;

CREATE TABLE `marca` (
  `idmarca` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagen` text COLLATE utf8mb4_unicode_ci,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idmarca`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `marca` */

insert  into `marca`(`idmarca`,`nombre`,`slug`,`imagen`,`estado`) values (1,'m1','m1','MrCljJsXCoryKGTzFoVyIENSf8nnPWqtoRwhCckh.jpg',1);

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `idmenu` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pariente` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idtipo_ruta` int(11) DEFAULT NULL,
  `ruta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `posicion` int(11) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idmenu`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `menu` */

insert  into `menu`(`idmenu`,`pariente`,`nombre`,`slug`,`idtipo_ruta`,`ruta`,`posicion`,`estado`,`created_at`,`updated_at`) values (1,NULL,'home','home',2,'web.home',1,1,NULL,NULL);
insert  into `menu`(`idmenu`,`pariente`,`nombre`,`slug`,`idtipo_ruta`,`ruta`,`posicion`,`estado`,`created_at`,`updated_at`) values (2,NULL,'m1','m1',3,'adasd',1,1,NULL,NULL);
insert  into `menu`(`idmenu`,`pariente`,`nombre`,`slug`,`idtipo_ruta`,`ruta`,`posicion`,`estado`,`created_at`,`updated_at`) values (3,0,'m2','m2',2,'web.contacto',3,1,NULL,NULL);
insert  into `menu`(`idmenu`,`pariente`,`nombre`,`slug`,`idtipo_ruta`,`ruta`,`posicion`,`estado`,`created_at`,`updated_at`) values (4,3,'m2.1','m21',3,'hmgj',1,1,NULL,NULL);

/*Table structure for table `metodo_pago` */

DROP TABLE IF EXISTS `metodo_pago`;

CREATE TABLE `metodo_pago` (
  `idmetodo_pago` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idmetodo_pago`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `metodo_pago` */

insert  into `metodo_pago`(`idmetodo_pago`,`nombre`,`estado`) values (1,'MERCADO PAGO',1);

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (2,'2014_10_12_100000_create_password_resets_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (3,'2019_08_19_000000_create_failed_jobs_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (4,'2022_01_11_043826_create_banners_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (5,'2022_01_11_045242_create_banner_imagens_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (6,'2022_01_11_045819_create_paginas_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (7,'2022_01_11_051601_create_menus_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (8,'2022_01_11_052153_create_blogs_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (9,'2022_01_11_052442_create_servicios_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (10,'2022_01_11_053519_create_servicio_imagens_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (11,'2022_01_11_053651_create_categoria_productos_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (12,'2022_01_11_054127_create_productos_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (13,'2022_01_11_054918_create_producto_imagens_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (14,'2022_01_11_055312_create_suscripcions_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (15,'2022_01_11_055719_create_contactos_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (16,'2022_01_11_055909_create_empresas_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (17,'2022_01_11_060414_create_nosotros_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (18,'2022_02_21_235633_create_marca_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (19,'2022_02_21_235821_create_categoria_has_producto_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (20,'2022_02_22_000645_create_cupon_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (21,'2022_02_22_000658_create_cliente_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (22,'2022_02_22_000849_create_venta_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (23,'2022_02_22_000921_create_venta_detalle_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (24,'2022_02_22_001000_create_tipo_comprobante_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (25,'2022_02_22_001324_create_status_venta_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (26,'2022_02_22_001342_create_status_envio_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (27,'2022_02_22_001354_create_status_pago_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (28,'2022_02_22_011428_create_tipo_descuento_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (29,'2022_02_22_011447_create_tipo_uso_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (30,'2022_02_22_032134_create_metodo_pago_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (31,'2022_02_22_180843_create_tipo_documento_identidad_table',1);

/*Table structure for table `nosotros` */

DROP TABLE IF EXISTS `nosotros`;

CREATE TABLE `nosotros` (
  `idnosotros` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mision` text COLLATE utf8mb4_unicode_ci,
  `vision` text COLLATE utf8mb4_unicode_ci,
  `quienes_somos` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`idnosotros`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `nosotros` */

/*Table structure for table `pagina` */

DROP TABLE IF EXISTS `pagina`;

CREATE TABLE `pagina` (
  `idpagina` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitulo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `autor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `contenido` text COLLATE utf8mb4_unicode_ci,
  `imagen` text COLLATE utf8mb4_unicode_ci,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idpagina`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pagina` */

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `proyecto` */

DROP TABLE IF EXISTS `proyecto`;

CREATE TABLE `proyecto` (
  `idproyecto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) DEFAULT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `descripcion` text,
  `contenido` text,
  `imagen` text,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idproyecto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `proyecto` */

/*Table structure for table `proyecto_imagen` */

DROP TABLE IF EXISTS `proyecto_imagen`;

CREATE TABLE `proyecto_imagen` (
  `idproyecto_imagen` int(11) NOT NULL AUTO_INCREMENT,
  `idproyecto` int(11) DEFAULT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `posicion` int(11) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idproyecto_imagen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `proyecto_imagen` */

/*Table structure for table `servicio` */

DROP TABLE IF EXISTS `servicio`;

CREATE TABLE `servicio` (
  `idservicio` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `contenido` text COLLATE utf8mb4_unicode_ci,
  `imagen` text COLLATE utf8mb4_unicode_ci,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idservicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `servicio` */

/*Table structure for table `servicio_imagen` */

DROP TABLE IF EXISTS `servicio_imagen`;

CREATE TABLE `servicio_imagen` (
  `idservicio_imagen` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idservicio` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `posicion` int(11) NOT NULL DEFAULT '1',
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idservicio_imagen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `servicio_imagen` */

/*Table structure for table `status_envio` */

DROP TABLE IF EXISTS `status_envio`;

CREATE TABLE `status_envio` (
  `idstatus_envio` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idstatus_envio`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `status_envio` */

insert  into `status_envio`(`idstatus_envio`,`nombre`,`estado`) values (1,'en espera de envío',1);
insert  into `status_envio`(`idstatus_envio`,`nombre`,`estado`) values (2,'enviado',1);
insert  into `status_envio`(`idstatus_envio`,`nombre`,`estado`) values (3,'entregado',1);
insert  into `status_envio`(`idstatus_envio`,`nombre`,`estado`) values (4,'devuelto',1);
insert  into `status_envio`(`idstatus_envio`,`nombre`,`estado`) values (5,'no se entrego',1);

/*Table structure for table `status_pago` */

DROP TABLE IF EXISTS `status_pago`;

CREATE TABLE `status_pago` (
  `status_pago` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`status_pago`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `status_pago` */

insert  into `status_pago`(`status_pago`,`nombre`,`estado`) values (1,'En espera de pago',1);
insert  into `status_pago`(`status_pago`,`nombre`,`estado`) values (2,'pagado',1);
insert  into `status_pago`(`status_pago`,`nombre`,`estado`) values (3,'cancelado',1);
insert  into `status_pago`(`status_pago`,`nombre`,`estado`) values (4,'reembolsado',1);

/*Table structure for table `status_venta` */

DROP TABLE IF EXISTS `status_venta`;

CREATE TABLE `status_venta` (
  `idstatus_venta` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idstatus_venta`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `status_venta` */

insert  into `status_venta`(`idstatus_venta`,`nombre`,`estado`) values (1,'recibido',1);
insert  into `status_venta`(`idstatus_venta`,`nombre`,`estado`) values (2,'finalizado',1);
insert  into `status_venta`(`idstatus_venta`,`nombre`,`estado`) values (3,'cancelado',1);

/*Table structure for table `suscripcion` */

DROP TABLE IF EXISTS `suscripcion`;

CREATE TABLE `suscripcion` (
  `idsuscripcion` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_registro` datetime NOT NULL,
  PRIMARY KEY (`idsuscripcion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `suscripcion` */

/*Table structure for table `tipo_comprobante` */

DROP TABLE IF EXISTS `tipo_comprobante`;

CREATE TABLE `tipo_comprobante` (
  `idtipo_comprobante` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nro_correlativo` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nro_serie` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idtipo_comprobante`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tipo_comprobante` */

insert  into `tipo_comprobante`(`idtipo_comprobante`,`nombre`,`nro_correlativo`,`nro_serie`,`estado`) values (1,'boleta','001','0',1);
insert  into `tipo_comprobante`(`idtipo_comprobante`,`nombre`,`nro_correlativo`,`nro_serie`,`estado`) values (2,'factura','002','0',1);

/*Table structure for table `tipo_descuento` */

DROP TABLE IF EXISTS `tipo_descuento`;

CREATE TABLE `tipo_descuento` (
  `idtipo_descuento` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idtipo_descuento`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tipo_descuento` */

insert  into `tipo_descuento`(`idtipo_descuento`,`nombre`,`estado`) values (1,'Moneda S/.',1);
insert  into `tipo_descuento`(`idtipo_descuento`,`nombre`,`estado`) values (2,'Porcentaje %',1);

/*Table structure for table `tipo_documento_identidad` */

DROP TABLE IF EXISTS `tipo_documento_identidad`;

CREATE TABLE `tipo_documento_identidad` (
  `idtipo_documento_identidad` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idtipo_documento_identidad`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tipo_documento_identidad` */

insert  into `tipo_documento_identidad`(`idtipo_documento_identidad`,`nombre`,`estado`) values (1,'DNI',1);
insert  into `tipo_documento_identidad`(`idtipo_documento_identidad`,`nombre`,`estado`) values (2,'Pasaporte',1);
insert  into `tipo_documento_identidad`(`idtipo_documento_identidad`,`nombre`,`estado`) values (3,'Carnet de Extanjeria',1);

/*Table structure for table `tipo_ruta` */

DROP TABLE IF EXISTS `tipo_ruta`;

CREATE TABLE `tipo_ruta` (
  `idtipo_ruta` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idtipo_ruta`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tipo_ruta` */

insert  into `tipo_ruta`(`idtipo_ruta`,`nombre`,`estado`) values (1,'Sin Ruta',1);
insert  into `tipo_ruta`(`idtipo_ruta`,`nombre`,`estado`) values (2,'Interna',1);
insert  into `tipo_ruta`(`idtipo_ruta`,`nombre`,`estado`) values (3,'Externa',1);

/*Table structure for table `tipo_uso` */

DROP TABLE IF EXISTS `tipo_uso`;

CREATE TABLE `tipo_uso` (
  `idtipo_uso` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idtipo_uso`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tipo_uso` */

insert  into `tipo_uso`(`idtipo_uso`,`nombre`,`estado`) values (1,'Unico',1);
insert  into `tipo_uso`(`idtipo_uso`,`nombre`,`estado`) values (2,'Múltiple',1);

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `idusuario` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombres` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellidos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usuario` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `imagen` text COLLATE utf8mb4_unicode_ci,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `usuario` */

insert  into `usuario`(`idusuario`,`nombres`,`apellidos`,`usuario`,`email`,`password`,`email_verified_at`,`imagen`,`estado`,`remember_token`,`created_at`,`updated_at`) values (1,'Admin','','admin','admin@example.com','eyJpdiI6IjY2MHgwbFdNU2JZbGZmWHVWeE5LXC9RPT0iLCJ2YWx1ZSI6ImVmTThqb0hVVkhcL2tTdGdLU1lvbnM2WG5WR0pYZlV6YTgxTkQ1MlYxXC91MD0iLCJtYWMiOiIxZGQ4ZGJjYzRkMDUxODg1MGUzMTM2NTQ4ZjMyYjU0MTk4MWM0YmYwZWNmZTU2M2U4MTBlZTY1ZThhNjAyYTMzIn0=','2022-02-23 16:00:30',NULL,1,NULL,NULL,NULL);

/*Table structure for table `venta` */

DROP TABLE IF EXISTS `venta`;

CREATE TABLE `venta` (
  `idventa` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idtransaccion` int(11) DEFAULT NULL,
  `idstatus_venta` int(11) DEFAULT NULL,
  `idstatus_envio` int(11) DEFAULT NULL,
  `idcupon` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `precio_envio` int(11) DEFAULT NULL,
  `descuento` int(11) DEFAULT NULL,
  `total_final` int(11) DEFAULT NULL,
  `receptor_pedido` int(11) DEFAULT NULL,
  `cliente_idcliente` int(11) DEFAULT NULL,
  `cliente_telefono` text COLLATE utf8mb4_unicode_ci,
  `cliente_direccion_linea1` text COLLATE utf8mb4_unicode_ci,
  `cliente_direccion_linea2` text COLLATE utf8mb4_unicode_ci,
  `cliente_referencia` text COLLATE utf8mb4_unicode_ci,
  `cliente_iddepartamento` int(11) DEFAULT NULL,
  `cliente_idprovincia` int(11) DEFAULT NULL,
  `cliente_iddistrito` int(11) DEFAULT NULL,
  `facturacion_idtipo_comprobante` int(11) DEFAULT NULL,
  `facturacion_nro_comprobante` int(11) DEFAULT NULL,
  `facturacion_ruc` int(11) DEFAULT NULL,
  `facturacion_razonsocial` int(11) DEFAULT NULL,
  `pago_idmetodo_pago` int(11) DEFAULT NULL,
  `pago_idstatus_pago` int(11) DEFAULT NULL,
  `pago_mercadopago_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pago_ticket` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pago_cuotas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pago_cip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pago_expira_cip` datetime DEFAULT NULL,
  `pago_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pago_mensaje` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `fecha_pago` datetime DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`idventa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `venta` */

/*Table structure for table `venta_detalle` */

DROP TABLE IF EXISTS `venta_detalle`;

CREATE TABLE `venta_detalle` (
  `idventa_detalle` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idventa` int(11) DEFAULT NULL,
  `idproducto` int(11) DEFAULT NULL,
  `precio` decimal(8,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `total` decimal(11,2) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idventa_detalle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `venta_detalle` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
