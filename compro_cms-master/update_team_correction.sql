-- Update Designations
-- Ensure IDs exist or insert if missing
INSERT IGNORE INTO designations (id, title, slug, status, created_at, updated_at) VALUES 
(10, 'Komisaris Utama', 'komisaris-utama', 1, NOW(), NOW());

-- Update existing designations to match user request exact naming
UPDATE designations SET title = 'Chief Executive Officer (CEO)', slug = 'ceo' WHERE id = 4;
UPDATE designations SET title = 'Chief Finance, Human Resource & General Affair (CFHRGA)', slug = 'cfhrga' WHERE id = 5;
UPDATE designations SET title = 'Head Unit of IT Solution', slug = 'head-unit-of-it-solution' WHERE id = 6;
UPDATE designations SET title = 'Head Unit of Manpower Provider', slug = 'head-unit-of-manpower-provider' WHERE id = 7;
UPDATE designations SET title = 'Head Unit of Finance & Accounting', slug = 'head-unit-of-finance-accounting' WHERE id = 8;
UPDATE designations SET title = 'Head Unit of Human Resource & General Affair', slug = 'head-unit-of-human-resource-general-affair' WHERE id = 9;

-- Re-populate members with correct mapping and images
TRUNCATE TABLE members;

INSERT INTO members (designation_id, title, slug, image_path, status, created_at, updated_at) VALUES
(10, 'Mahat Kusumadi', 'mahat-kusumadi', '1.jpeg', 1, NOW(), NOW()),
(4, 'Agung Dermawan', 'agung-dermawan', '2.jpeg', 1, NOW(), NOW()),
(5, 'Namunsen', 'namunsen', '3.jpeg', 1, NOW(), NOW()),
(6, 'Subangkit', 'subangkit', '4.jpeg', 1, NOW(), NOW()),
(7, 'Lili', 'lili', '5.jpeg', 1, NOW(), NOW()),
(8, 'Ferry', 'ferry', '6.jpeg', 1, NOW(), NOW()),
(9, 'Maria', 'maria', '7.jpeg', 1, NOW(), NOW());
