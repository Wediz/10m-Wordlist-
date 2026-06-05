-- =====================================================
--  IMMO VISION 17 — Installation base de données
--  Commande: mysql -u USER -p NOM_BASE < install.sql
-- =====================================================

SET NAMES utf8mb4;
SET time_zone = '+00:00';

-- Tables
CREATE TABLE IF NOT EXISTS `properties` (
  `id`              INT AUTO_INCREMENT PRIMARY KEY,
  `slug`            VARCHAR(255) UNIQUE NOT NULL,
  `title`           VARCHAR(255) NOT NULL,
  `description`     TEXT,
  `price`           DECIMAL(12,2) NOT NULL,
  `surface`         DECIMAL(8,2) NOT NULL,
  `land_surface`    DECIMAL(10,2) DEFAULT NULL,
  `rooms`           INT DEFAULT 0,
  `bedrooms`        INT DEFAULT 0,
  `bathrooms`       INT DEFAULT 0,
  `type`            ENUM('maison','appartement','terrain','commerce','chateau','investissement') DEFAULT 'maison',
  `status`          ENUM('available','under_offer','sold') DEFAULT 'available',
  `city`            VARCHAR(100),
  `postal_code`     VARCHAR(10),
  `dpe_score`       CHAR(1) DEFAULT NULL,
  `ges_score`       CHAR(1) DEFAULT NULL,
  `has_pool`        TINYINT(1) DEFAULT 0,
  `has_garage`      TINYINT(1) DEFAULT 0,
  `has_garden`      TINYINT(1) DEFAULT 0,
  `has_sea_view`    TINYINT(1) DEFAULT 0,
  `has_terrace`     TINYINT(1) DEFAULT 0,
  `year_built`      INT DEFAULT NULL,
  `image_url`       VARCHAR(500),
  `image2_url`      VARCHAR(500) DEFAULT NULL,
  `image3_url`      VARCHAR(500) DEFAULT NULL,
  `is_featured`     TINYINT(1) DEFAULT 0,
  `is_drone`        TINYINT(1) DEFAULT 0,
  `virtual_tour_url` VARCHAR(500) DEFAULT NULL,
  `created_at`      TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `estimation_leads` (
  `id`             INT AUTO_INCREMENT PRIMARY KEY,
  `first_name`     VARCHAR(100),
  `last_name`      VARCHAR(100),
  `email`          VARCHAR(255),
  `phone`          VARCHAR(20),
  `property_type`  VARCHAR(50),
  `address`        VARCHAR(255),
  `city`           VARCHAR(100),
  `postal_code`    VARCHAR(10),
  `surface`        DECIMAL(8,2),
  `rooms`          INT,
  `condition_state` VARCHAR(50),
  `has_pool`       TINYINT(1) DEFAULT 0,
  `has_garage`     TINYINT(1) DEFAULT 0,
  `has_garden`     TINYINT(1) DEFAULT 0,
  `notes`          TEXT,
  `status`         ENUM('pending','contacted','completed') DEFAULT 'pending',
  `created_at`     TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id`         INT AUTO_INCREMENT PRIMARY KEY,
  `first_name` VARCHAR(100),
  `last_name`  VARCHAR(100),
  `email`      VARCHAR(255),
  `phone`      VARCHAR(20),
  `subject`    VARCHAR(255),
  `message`    TEXT,
  `status`     ENUM('unread','read','replied') DEFAULT 'unread',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `crm_deals` (
  `id`               INT AUTO_INCREMENT PRIMARY KEY,
  `title`            VARCHAR(255),
  `client_name`      VARCHAR(255),
  `client_email`     VARCHAR(255),
  `client_phone`     VARCHAR(20),
  `property_address` VARCHAR(255),
  `value`            DECIMAL(12,2),
  `stage`            VARCHAR(50) DEFAULT 'prospect',
  `priority`         ENUM('low','medium','high') DEFAULT 'medium',
  `notes`            TEXT,
  `next_action`      VARCHAR(255),
  `created_at`       TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at`       TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `blog_posts` (
  `id`           INT AUTO_INCREMENT PRIMARY KEY,
  `slug`         VARCHAR(255) UNIQUE NOT NULL,
  `title`        VARCHAR(255) NOT NULL,
  `excerpt`      TEXT,
  `content`      LONGTEXT,
  `cover_image`  VARCHAR(500),
  `author`       VARCHAR(100) DEFAULT 'Immo Vision 17',
  `tags`         VARCHAR(500),
  `published_at` TIMESTAMP NULL,
  `created_at`   TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =====================================================
--  DONNÉES DE DÉMONSTRATION
-- =====================================================

INSERT IGNORE INTO `properties`
(slug,title,description,price,surface,land_surface,rooms,bedrooms,bathrooms,type,city,postal_code,dpe_score,has_pool,has_garage,has_garden,has_sea_view,has_terrace,year_built,image_url,image2_url,image3_url,is_featured,is_drone) VALUES
('villa-prestige-royan-vue-mer','Villa Prestige avec Vue Mer Panoramique',
'Exceptionnelle villa à Royan offrant une vue panoramique sur l\'Atlantique. Architecture contemporaine, finitions premium, piscine, jardin paysager, 4 chambres, cinéma maison.',
1250000,280,1200,7,4,3,'maison','Royan','17200','B',1,1,1,1,1,2019,
'https://images.unsplash.com/photo-1613977257363-707ba9348227?w=800',
'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=800',
'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800',1,1),

('maison-saintongeaise-saintes-centre','Maison Saintongeaise Rénovée — Centre Saintes',
'Magnifique maison saintongeaise entièrement rénovée avec matériaux de qualité. Pierre apparente, parquet, cheminée. 5 chambres, grand jardin clos, double garage.',
485000,195,800,8,5,2,'maison','Saintes','17100','C',0,1,1,0,1,1890,
'https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=800',
'https://images.unsplash.com/photo-1583608205776-bfd35f0d9f83?w=800',NULL,1,0),

('appartement-vue-port-rochefort','Appartement Vue Port — Rochefort',
'Superbe appartement avec vue sur le port de Rochefort. Entièrement rénové, 2 chambres, balcon, cave et parking.',
295000,87,NULL,4,2,1,'appartement','Rochefort','17300','D',0,1,0,1,1,1970,
'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800',NULL,NULL,1,0),

('chateau-saintonge-jonzac','Château Saintonge avec Vignoble',
'Magnifique château XVIIIe siècle avec 15ha de vignoble. 15 pièces, piscine, dépendances, cave à vin. Idéal investissement premium.',
890000,450,150000,15,8,4,'chateau','Jonzac','17500','E',1,1,1,0,1,1750,
'https://images.unsplash.com/photo-1533154683836-84ea7a0bc310?w=800',NULL,NULL,0,0),

('maison-contemporaine-cognac','Maison Contemporaine BBC — Cognac',
'Belle maison contemporaine BBC architecte, plain-pied. 138m², 3 chambres, suite parentale, piscine couverte. Quartier résidentiel calme.',
325000,138,600,6,3,2,'maison','Cognac','16100','A',1,1,1,0,1,2018,
'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800',NULL,NULL,0,0),

('terrain-constructible-pons','Terrain Constructible Viabilisé — Pons',
'Beau terrain constructible 850m² entièrement viabilisé (eau, électricité, tout-à-l\'égout). Permis de construire accordé. Vue dégagée.',
85000,850,NULL,0,0,0,'terrain','Pons','17800',NULL,0,0,0,0,0,NULL,
'https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=800',NULL,NULL,0,0);

INSERT IGNORE INTO `blog_posts` (slug,title,excerpt,content,cover_image,tags,published_at) VALUES
('marche-immobilier-charente-maritime-2024',
'Marché immobilier Charente-Maritime 2024',
'Analyse des tendances de prix, volumes de ventes et secteurs porteurs dans le département 17.',
'<p>Article complet à venir...</p>',
'https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=800',
'marché,analyse,2024', NOW()),

('vendre-bien-immobilier-charente-maritime',
'Comment vendre votre bien au meilleur prix',
'Les étapes clés pour réussir votre vente : estimation, préparation, mise en valeur.',
'<p>Article complet à venir...</p>',
'https://images.unsplash.com/photo-1582407947304-fd86f028f716?w=800',
'vente,conseils', NOW()),

('visite-virtuelle-immobilier-avantages',
'Visite virtuelle 360° : pourquoi c\'est indispensable',
'76% des acheteurs exigent désormais la visite virtuelle avant de se déplacer.',
'<p>Article complet à venir...</p>',
'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=800',
'technologie,visite virtuelle', NOW()),

('investissement-locatif-royan',
'Investissement locatif à Royan et sur le littoral',
'Rentabilité, fiscalité et secteurs porteurs pour investir sur la côte atlantique.',
'<p>Article complet à venir...</p>',
'https://images.unsplash.com/photo-1560185127-6a8d9dce4f64?w=800',
'investissement,Royan', NOW());

INSERT INTO `crm_deals` (title,client_name,client_email,client_phone,value,stage,priority,next_action) VALUES
('Villa Royan','M. Martin','martin@email.fr','06 11 22 33 44',850000,'visite','high','Contre-visite jeudi'),
('Appart Saintes','Mme Bernard','bernard@email.fr','06 55 66 77 88',195000,'negociation','medium','Offre à transmettre'),
('Maison Rochefort','M. & Mme Petit','petit@email.fr','06 99 88 77 66',320000,'compromis','high','Signature notaire 15/07'),
('Terrain Cognac','M. Dubois','dubois@email.fr',NULL,85000,'prospect','low',NULL),
('Château Jonzac','Famille Leclerc','leclerc@email.fr','06 44 33 22 11',1200000,'contact','high','RDV estimation lundi');
