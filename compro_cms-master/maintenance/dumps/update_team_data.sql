-- Clear existing members to avoid duplicates or mismatch
TRUNCATE TABLE members;

-- Insert members with best-guess designations based on standard hierarchy
-- 4: CEO, 5: CFHRGA, 6: IT, 7: Man Power, 8: Finance, 9: HRGA
-- Mahat Kusumadi -> CEO (4)
-- Agung Dermawan -> CFHRGA (5) or IT (6)? Usually 2nd is high level. Let's assign CFHRGA.
-- Namunsen -> Head Unit of IT Solution (6)
-- Subangkit -> Head Unit of Man Power Provider (7)
-- Lili -> Head Unit of Finance (8)
-- Ferry -> Head Unit of HRGA (9)
-- Maria -> Team Member (1) (Fallback)

INSERT INTO members (designation_id, title, slug, status, created_at, updated_at) VALUES
(4, 'Mahat Kusumadi', 'mahat-kusumadi', 1, NOW(), NOW()),
(5, 'Agung Dermawan', 'agung-dermawan', 1, NOW(), NOW()),
(6, 'Namunsen', 'namunsen', 1, NOW(), NOW()),
(7, 'Subangkit', 'subangkit', 1, NOW(), NOW()),
(8, 'Lili', 'lili', 1, NOW(), NOW()),
(9, 'Ferry', 'ferry', 1, NOW(), NOW()),
(1, 'Maria', 'maria', 1, NOW(), NOW());

-- Validation query
SELECT * FROM members;
