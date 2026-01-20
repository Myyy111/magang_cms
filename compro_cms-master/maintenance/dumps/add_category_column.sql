-- Add kategori column if it doesn't exist (using procedure or just ignoring error if simple query not supported, but standard ADD COLUMN works if not exists on newer MySQL, or check schema first)
-- Since I know it doesn't exist, I'll just add it.
ALTER TABLE members ADD COLUMN kategori VARCHAR(50) AFTER slug;

-- Update categories based on designations
-- Komisaris (10)
UPDATE members SET kategori = 'komisaris' WHERE designation_id = 10;

-- Direksi (4, 5)
UPDATE members SET kategori = 'direksi' WHERE designation_id IN (4, 5);

-- Head Unit (6, 7, 8, 9)
UPDATE members SET kategori = 'head_unit' WHERE designation_id IN (6, 7, 8, 9);

-- Final check
SELECT id, title, designation_id, kategori FROM members;
