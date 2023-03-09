CREATE TABLE user_(
    id int AUTO_INCREMENT ,
    login_ varchar(50),
    password_ varchar(50),
    email varchar(50),
    PRIMARY KEY(id)
    );
CREATE TABLE admin(
    id int AUTO_INCREMENT ,
    login_ varchar(50),
    password_ varchar(50),
    email varchar(50),
    PRIMARY KEY(id)
    );
CREATE TABLE orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  pizza_id INT NOT NULL,
  quantity INT NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  status_ BOOLEAN DEFAULT 0,
  date_ DATETIME NOT NULL
);

INSERT INTO `admin`(`login_`, `password_`, `email`) VALUES ('pizzaman','51d173b557122f3f9ded11fd8cccd0002ef48682','capriciosa@pizza.com')
-- password="capriciosa"
-- 51d173b557122f3f9ded11fd8cccd0002ef48682
