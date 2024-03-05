CREATE TABLE user_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(100),
    gender ENUM('male', 'female', 'other'),
    course VARCHAR(100),
    description TEXT
);