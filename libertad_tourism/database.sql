CREATE DATABASE IF NOT EXISTS libertad_tourism CHARACTER SET utf8mb4;
USE libertad_tourism;

CREATE TABLE IF NOT EXISTS admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS spots (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  tagline VARCHAR(200),
  description TEXT,
  how_to_get TEXT,
  tips TEXT,
  color VARCHAR(7) DEFAULT '#2e7d5b',
  image VARCHAR(255) DEFAULT NULL,
  sort_order INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS settings (
  k VARCHAR(50) PRIMARY KEY,
  v TEXT
);

CREATE TABLE IF NOT EXISTS messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100), email VARCHAR(120), message TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO settings (k,v) VALUES
('site_title','Discover San Roque'),
('tagline','Tourist spots of Sitio San Juan, Libertad'),
('about','San Roque, Sitio San Juan, Libertad is home to beautiful natural spots waiting to be explored. Visit Baluon, Mt. Pinupo and Parigusan it Pari, and experience the beauty and warm hospitality of our community.'),
('contact_name','San Roque Tourism Office'),
('contact_phone','09XX-XXX-XXXX'),
('contact_email','tourism@example.com'),
('contact_address','San Roque, Sitio San Juan, Libertad')
ON DUPLICATE KEY UPDATE k=k;

INSERT INTO spots (name,tagline,description,how_to_get,tips,color,sort_order) VALUES
('Baluon','A peaceful nature escape','Baluon is one of the attractions of San Roque. Edit this description from the Admin panel.','Travel to Sitio San Juan, Libertad, then follow the local path to the spot. Ask locals for directions.','Bring water, wear comfortable footwear, and keep the place clean.','#1f7a8c',1),
('Mt. Pinupo','Hike up for the view','Mt. Pinupo offers a hiking experience and scenic views. Edit this description from the Admin panel.','Start from Sitio San Juan, Libertad. A local guide is recommended.','Start early, bring water and snacks, and wear proper hiking shoes.','#3b7d3a',2),
('Parigusan it Pari','A hidden local treasure','Parigusan it Pari is a spot loved by locals. Edit this description from the Admin panel.','Travel to San Roque, Sitio San Juan, Libertad and ask locals for the way.','Respect nature, avoid littering, and go with a companion.','#b5651d',3);
