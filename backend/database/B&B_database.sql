CREATE DATABASE BytesAndBits;
USE BytesAndBits;


CREATE TABLE `bytesandbits`.`Rol`(
    `rol_id`    INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `rol_name`  VARCHAR(60) NOT NULL UNIQUE
);

INSERT INTO `bytesandbits`.`Rol` (`rol_name`) VALUES
('seller'),
('buyer'),
('administrator'),
('super administrator');

CREATE TABLE `bytesandbits`.`User`(
    `user_id`           INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `user_email`        VARCHAR(60) NOT NULL UNIQUE,
    `user_userName`     VARCHAR(60) NOT NULL UNIQUE,
    `user_password`     VARCHAR(255) NOT NULL,
    `user_name`         VARCHAR(60) NOT NULL,
    `user_lastName`     VARCHAR(60) NOT NULL,
    `user_birthDate`    DATE NOT NULL,
    `user_image`        LONGBLOB NOT NULL,
    `user_gender`       VARCHAR(60) NOT NULL,
    `user_lastDate`     DATETIME NOT NULL DEFAULT NOW(),
    `user_isPublic`     TINYINT NOT NULL,
    `user_isEnable`     TINYINT NOT NULL DEFAULT 1,
    `user_rol`          VARCHAR(60) NOT NULL,
    FOREIGN KEY (`user_rol`) REFERENCES `bytesandbits`.`rol`(`rol_name`)
);


CREATE TABLE `bytesandbits`.`Address`(
    `address_id`            INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `address_street`        TEXT NOT NULL,
    `address_city`          VARCHAR(60) NOT NULL,
    `address_state`         VARCHAR(60) NOT NULL,
    `address_postalCode`    VARCHAR(60) NOT NULL,
    `address_country`       VARCHAR(60) NOT NULL,
    `address_isEnable`      TINYINT NOT NULL DEFAULT 1,
    `address_user`          INT NOT NULL,
    FOREIGN KEY (`address_user`) REFERENCES `bytesandbits`.`User`(`user_id`)
);

CREATE TABLE `bytesandbits`.`Product`(
    `product_id`                INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `product_name`              VARCHAR(60) NOT NULL,
    `product_description`       TEXT NOT NULL,
    `product_image`             LONGBLOB NOT NULL,
    `product_isApproved`        TINYINT NOT NULL DEFAULT 0,
    `product_quotation`         TINYINT NOT NULL,
    `product_price`             DECIMAL,
    `product_quantityAvailable` INT,
    `product_isEnable`          TINYINT NOT NULL DEFAULT 1,
    `product_createdAt`         DATETIME NOT NULL DEFAULT NOW(),
    `product_user`              INT NOT NULL,
    FOREIGN KEY (`product_user`) REFERENCES `bytesandbits`.`User`(`user_id`)
);

CREATE TABLE `bytesandbits`.`Image`(
    `image_id`          INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `image_content`     LONGBLOB NOT NULL,
    `image_isEnable`    TINYINT NOT NULL DEFAULT 1,
    `image_product`     INT NOT NULL,
    FOREIGN KEY (`image_product`) REFERENCES `bytesandbits`.`Product`(`product_id`)
);

CREATE TABLE `bytesandbits`.`Video`(
    `video_id`          INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `video_content`     LONGBLOB NOT NULL,
    `video_isEnable`    TINYINT NOT NULL DEFAULT 1,
    `video_product`     INT NOT NULL,
    FOREIGN KEY (`video_product`) REFERENCES `bytesandbits`.`Product`(`product_id`)
);

CREATE TABLE `bytesandbits`.`Quotation`(
    `quotation_id`              INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `quotation_expirationDate`  DATETIME,
    `quotation_specifications`  TEXT NOT NULL,
    `quotation_priceAgreed`     DECIMAL(10, 10),
    `quotation_isEnable`        TINYINT NOT NULL DEFAULT 1,
    `quotation_product`         INT NOT NULL,
    `quotation_user`            INT NOT NULL,
    FOREIGN KEY (`quotation_product`) REFERENCES `bytesandbits`.`Product`(`product_id`),
    FOREIGN KEY (`quotation_user`) REFERENCES `bytesandbits`.`User`(`user_id`)
);

CREATE TABLE `bytesandbits`.`List`(
    `list_id`           INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `list_name`         VARCHAR(60) NOT NULL,
    `list_description`  TEXT NOT NULL,
    `list_isPublic`     TINYINT NOT NULL,
    `list_isEnable`     TINYINT NOT NULL DEFAULT 1,
    `list_user`         INT NOT NULL,
    FOREIGN KEY (`list_user`) REFERENCES `bytesandbits`.`User`(`user_id`)
);

CREATE TABLE `bytesandbits`.`imageList`(
    `imageList_id` 			INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `imageList_content` 	LONGBLOB NOT NULL,
    `imageList_isEnable` 	TINYINT NOT NULL DEFAULT 1,
    `imageList_list` 		INT NOT NULL,
    FOREIGN KEY (`imageList_list`) REFERENCES `bytesandbits`.`List`(`list_id`)
);

CREATE TABLE `bytesandbits`.`List_Product`(
    `listProduct_id`        INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `listProduct_isEnable`  TINYINT NOT NULL DEFAULT 1,
    `listProduct_list`      INT NOT NULL,
    `listProduct_product`   INT NOT NULL,
    FOREIGN KEY (`listProduct_list`) REFERENCES `bytesandbits`.`List`(`list_id`),
    FOREIGN KEY (`listProduct_product`) REFERENCES `bytesandbits`.`Product`(`product_id`)
);

    CREATE TABLE `bytesandbits`.`Category`(
        `category_id`           INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
        `category_name`         VARCHAR(60) NOT NULL,
        `category_description`  TEXT NOT NULL,
        `category_isEnable`     TINYINT NOT NULL DEFAULT 1,
        `category_user`         INT NOT NULL,
        FOREIGN KEY (`category_user`) REFERENCES `bytesandbits`.`User`(`user_id`)
    );

    CREATE TABLE `bytesandbits`.`Category_Product`(
        `categoryProduct_id`        INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
        `categoryProduct_isEnable`  TINYINT NOT NULL DEFAULT 1,
        `categoryProduct_product`   INT NOT NULL,
        `categoryProduct_category`  INT NOT NULL,
        FOREIGN KEY (`categoryProduct_product`) REFERENCES `bytesandbits`.`Product`(`product_id`),
        FOREIGN KEY (`categoryProduct_category`) REFERENCES `bytesandbits`.`Category`(`category_id`)
    );

CREATE TABLE `bytesandbits`.`Rating`(
    `rating_id`         INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `rating_score`      INT NOT NULL,
    `rating_comment`    TEXT,
    `rating_isEnable`   TINYINT NOT NULL DEFAULT 1,
    `rating_product`    INT NOT NULL,
    `rating_user`       INT NOT NULL,
    FOREIGN KEY (`rating_product`) REFERENCES `bytesandbits`.`Product`(`product_id`),
    FOREIGN KEY (`rating_user`) REFERENCES `bytesandbits`.`User`(`user_id`)
);

CREATE TABLE `bytesandbits`.`Cart`(
    `cart_id`           INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `cart_createdAt`    DATETIME NOT NULL DEFAULT NOW(),
    `cart_isEnable`     TINYINT NOT NULL DEFAULT 1,
    `cart_user`         INT NOT NULL,
    FOREIGN KEY (`cart_user`) REFERENCES `bytesandbits`.`User`(`user_id`)
);

CREATE TABLE `bytesandbits`.`Cart_Item`(
    `cartItem_id`       INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `cartItem_quantity` INT NOT NULL,
    `cartItem_isEnable` TINYINT NOT NULL DEFAULT 1,
    `cartItem_product`  INT NOT NULL,
    `cartItem_cart`     INT NOT NULL,
    FOREIGN KEY (`cartItem_product`) REFERENCES `bytesandbits`.`Product`(`product_id`),
    FOREIGN KEY (`cartItem_cart`) REFERENCES `bytesandbits`.`Cart`(`cart_id`)
);

CREATE TABLE `bytesandbits`.`Conversation`(
    `conversation_id`       INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `conversation_isEnable` TINYINT NOT NULL DEFAULT 1,
    `conversation_seller`   INT NOT NULL,
    `conversation_buyer`    INT NOT NULL,
    `conversation_product`  INT NOT NULL,
    FOREIGN KEY (`conversation_seller`) REFERENCES `bytesandbits`.`User`(`user_id`),
    FOREIGN KEY (`conversation_buyer`) REFERENCES `bytesandbits`.`User`(`user_id`),
    FOREIGN KEY (`conversation_product`) REFERENCES `bytesandbits`.`Product`(`product_id`)
);

CREATE TABLE `bytesandbits`.`Message`(
    `message_id`            INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `message_text`          TEXT NOT NULL,
    `message_date`          DATETIME NOT NULL DEFAULT NOW(),
    `message_conversation`  INT NOT NULL,
    `message_sender`        INT NOT NULL,
    FOREIGN KEY (`message_conversation`) REFERENCES `bytesandbits`.`Conversation`(`conversation_id`),
    FOREIGN KEY (`message_sender`) REFERENCES `bytesandbits`.`User`(`user_id`)
);

CREATE TABLE `bytesandbits`.`Sale`(
    `sale_id`       INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `sale_date`     DATETIME NOT NULL DEFAULT NOW(),
    `sale_product`  INT NOT NULL,
    `sale_seller`   INT NOT NULL,
    FOREIGN KEY (`sale_product`) REFERENCES `bytesandbits`.`Product`(`product_id`),
    FOREIGN KEY (`sale_seller`) REFERENCES `bytesandbits`.`User`(`user_id`)
);

CREATE TABLE `bytesandbits`.`Purchase`(
    `purchase_id`       INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `purchase_date`     DATETIME NOT NULL DEFAULT NOW(),
    `purchase_product`  INT NOT NULL,
    `purchase_buyer`    INT NOT NULL,
    FOREIGN KEY (`purchase_product`) REFERENCES `bytesandbits`.`Product`(`product_id`),
    FOREIGN KEY (`purchase_buyer`) REFERENCES `bytesandbits`.`User`(`user_id`)
);

CREATE TABLE `bytesandbits`.`adminMovements`(
    `adminMovements_id`         INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `adminMovements_idUser`     INT NOT NULL,
    `adminMovements_idProduct`  INT NOT NULL,
    FOREIGN KEY (`adminMovements_idUser`) REFERENCES `bytesandbits`.`User`(`user_id`),
    FOREIGN KEY (`adminMovements_idProduct`) REFERENCES `bytesandbits`.`Product`(`product_id`)
);

/*---------------VIEWS------------------------------------*/
    CREATE VIEW `ProductGeneralInfoView` AS
    SELECT 
        p.`product_id`,
        p.`product_name`,
        p.`product_description`,
        p.`product_price`,
        p.`product_quantityAvailable`,
        p.`product_image`
    FROM `bytesandbits`.`Product` p
    WHERE p.`product_isEnable` = 1;

    CREATE VIEW `ProductSpecificInfoView` AS
    SELECT 
        p.`product_id`,
        p.`product_name`,
        p.`product_description`,
        p.`product_price`,
        p.`product_quantityAvailable`,
        p.`product_image`,
        i.`image_content`,
        v.`video_content`
    FROM `bytesandbits`.`Product` p
    LEFT JOIN `bytesandbits`.`Image` i ON p.`product_id` = i.`image_product`
    LEFT JOIN `bytesandbits`.`Video` v ON p.`product_id` = v.`video_product`
    WHERE p.`product_isEnable` = 1;

    CREATE VIEW `SellerQuotationView` AS
    SELECT
        q.`quotation_id`,
        q.`quotation_expirationDate`,
        q.`quotation_specifications`,
        q.`quotation_priceAgreed`,
        q.`quotation_isEnable`,
        p.`product_id`,
        p.`product_name`,
        p.`product_image`
    FROM `bytesandbits`.`Quotation` q
    JOIN `bytesandbits`.`Product` p ON q.`quotation_product` = p.`product_id`;

    CREATE VIEW `BuyerQuotationView` AS
    SELECT
        q.`quotation_id`,
        q.`quotation_expirationDate`,
        q.`quotation_specifications`,
        q.`quotation_priceAgreed`,
        q.`quotation_isEnable`,
        p.`product_id`,
        p.`product_name`,
        p.`product_image`,
        u.`user_id`,
        u.`user_userName`,
        u.`user_image`
    FROM `bytesandbits`.`Quotation` q
    JOIN `bytesandbits`.`Product` p ON q.`quotation_product` = p.`product_id`
    JOIN `bytesandbits`.`User` u ON q.`quotation_user` = u.`user_id`;

    CREATE VIEW `CurrentProducts` AS
    SELECT
        p.`product_id`,
        p.`product_name`,
        p.`product_price`,
        p.`product_quantityAvailable`,
        c.`category_name`
    FROM `bytesandbits`.`Product` p
    JOIN `bytesandbits`.`Category_Product` cp ON p.`product_id` = cp.`categoryProduct_product`
    JOIN `bytesandbits`.`Category` c ON cp.`categoryProduct_category` = c.`category_id`;

    -- View de Consulta Detallada de Ventas
    CREATE VIEW `SalesDetailsView` AS
    SELECT
        s.`sale_id`,
        s.`sale_date`,
        c.`category_name`,
        p.`product_name`,
        COALESCE(AVG(r.`rating_score`), 0) AS average_rating,
        p.`product_price`,
        p.`product_stock`
    FROM `bytesandbits`.`Sale` s
    JOIN `bytesandbits`.`Product` p ON s.`sale_product` = p.`product_id`
    JOIN `bytesandbits`.`Category_Product` cp ON p.`product_id` = cp.`categoryProduct_product`
    JOIN `bytesandbits`.`Category` c ON cp.`categoryProduct_category` = c.`category_id`
    LEFT JOIN `bytesandbits`.`Rating` r ON r.`rating_product` = p.`product_id`
    GROUP BY s.`sale_id`;

    -- View de Consulta Agrupada de Ventas
    CREATE VIEW `SalesGroupedView` AS
    SELECT
        MONTH(s.`sale_date`) AS month,
        YEAR(s.`sale_date`) AS year,
        c.`category_name`,
        COUNT(s.`sale_id`) AS total_sales
    FROM `bytesandbits`.`Sale` s
    JOIN `bytesandbits`.`Product` p ON s.`sale_product` = p.`product_id`
    JOIN `bytesandbits`.`Category_Product` cp ON p.`product_id` = cp.`categoryProduct_product`
    JOIN `bytesandbits`.`Category` c ON cp.`categoryProduct_category` = c.`category_id`
    GROUP BY MONTH(s.`sale_date`), YEAR(s.`sale_date`), c.`category_name`;

    -- View de Consulta Detallada de Compras
    CREATE VIEW `PurchasesDetailsView` AS
    SELECT
        s.`sale_id`,
        s.`sale_date`,
        c.`category_name`,
        p.`product_name`,
        COALESCE(AVG(r.`rating_score`), 0) AS average_rating,
        p.`product_price`
    FROM `bytesandbits`.`Sale` s
    JOIN `bytesandbits`.`Product` p ON s.`sale_product` = p.`product_id`
    JOIN `bytesandbits`.`Category_Product` cp ON p.`product_id` = cp.`categoryProduct_product`
    JOIN `bytesandbits`.`Category` c ON cp.`categoryProduct_category` = c.`category_id`
    LEFT JOIN `bytesandbits`.`Rating` r ON r.`rating_product` = p.`product_id`
    GROUP BY s.`sale_id`;

    -- View de Consulta Agrupada de Compras
    CREATE VIEW `PurchasesGroupedView` AS
    SELECT
        MONTH(s.`sale_date`) AS month,
        YEAR(s.`sale_date`) AS year,
        c.`category_name`,
        COUNT(s.`sale_id`) AS total_purchases
    FROM `bytesandbits`.`Sale` s
    JOIN `bytesandbits`.`Product` p ON s.`sale_product` = p.`product_id`
    JOIN `bytesandbits`.`Category_Product` cp ON p.`product_id` = cp.`categoryProduct_product`
    JOIN `bytesandbits`.`Category` c ON cp.`categoryProduct_category` = c.`category_id`
    GROUP BY MONTH(s.`sale_date`), YEAR(s.`sale_date`), c.`category_name`;



/* CREATE VIEW userInfoView AS
SELECT
    `user_id`,       
    `user_email`,    
    `user_userName`, 
    `user_password`, 
    `user_name`,     
    `user_lastName`, 
    `user_birthDate`,
    `user_image`,    
    `user_gender`,
    `user_isPublic`, 
    `user_isEnable`, 
    `user_rol`
FROM  `bytesandbits`.`User` ;

CREATE VIEW ProductSpecificInfo AS
SELECT 
    p.`product_id`,
    p.`product_name`,
    p.`product_description`,
    p.`product_image`,
    p.`product_quotation`,
    p.`product_price`,
    p.`product_quantityAvailable`,
    p.`product_isEnable`,
    u.`user_id`,
    u.`user_userName`,
    u.`user_isPublic`,
    i.`image_content`,
    v.`video_content`
FROM 
    `bytesandbits`.`Product` p
LEFT JOIN 
    `bytesandbits`.`Image` i ON p.`product_id` = i.`image_product`
LEFT JOIN 
    `bytesandbits`.`Video` v ON p.`product_id` = v.`video_product`
INNER JOIN 
    `bytesandbits`.`User` u ON p.`product_user` = u.`user_id`;

CREATE VIEW ProductGeneralInfo AS
    SELECT
        p.`product_id`,
        p.`product_name`,
        p.`product_quotation`,
        p.`product_image`,
        p.`product_price`,
        u.`user_id`,
        u.`user_userName`
    FROM 
        `bytesandbits`.`Product` p
    JOIN
        `bytesandbits`.`User` u ON p.`product_user` = u.`user_id`;

CREATE VIEW CompleteList AS
    SELECT 
        l.`list_id`,
        l.`list_name`,
        l.`list_description`,
        l.`list_isPublic`,
        l.`list_isEnable`,
        u.`user_id`,
        u.`user_userName`,
        u.`user_image`,
        p.`product_id`,   
        p.`product_name`,
        p.`product_image`,
        il.`imageList_content`
    FROM `bytesandbits`.`List` l
    LEFT JOIN `bytesandbits`.`List_Product` lp ON l.`list_id` = lp.`listProduct_list`
    LEFT JOIN `bytesandbits`.`imageList` il ON l.`list_id` = il.`imageList_list`
    JOIN `bytesandbits`.`User` u ON l.`list_id` = u.`user_id`
    JOIN `bytesandbits`.`Product` p ON lp.`listProduct_product` = p.`product_id`;




CREATE VIEW ChatMessagesView AS
    SELECT
        m.`message_id`,
        m.`message_text`, 
        m.`message_date`, 
        m.`message_sender`,
        u.`user_id`,
        u.`user_userName`,
        u.`user_image`
    FROM `bytesandbits`.`Message` m
    INNER JOIN `bytesandbits`.`User` u ON m.`message_sender` = u.`user_id`;


    CREATE VIEW QuotationViewByBuyer AS
    SELECT 
        q.`quotation_expirationDate`,
        q.`quotation_specifications`,
        q.`quotation_priceAgreed`,
        q.`quotation_isEnable`,
        p.`product_id`,
        p.`product_name`,
        p.`product_image`
    FROM `bytesandbits`.`Quotation` q
    JOIN `bytesandbits`.`Product` p ON q.`quotation_product` = p.`product_id`;

    CREATE VIEW QuotationViewBySeller AS
    SELECT 
        q.`quotation_expirationDate`,
        q.`quotation_specifications`,
        q.`quotation_priceAgreed`,
        q.`quotation_isEnable`,
        p.`product_id`,
        p.`product_name`,
        p.`product_image`,
        u.`user_id`,
        u.`user_userName`,
        u.`user_image`
    FROM `bytesandbits`.`Quotation` q
    JOIN `bytesandbits`.`Product` p ON q.`quotation_product` = p.`product_id`
    JOIN `bytesandbits`.`User` u ON q.`quotation_user` = u.`user_id`
    GROUP BY u.`user_id`, p.`product_id`;

    CREATE VIEW ProductViewByCategory AS
    SELECT
        p.`product_id`,
        p.`product_name`,
        p.`product_image`
    FROM `bytesandbits`.`Product` p
    JOIN `bytesandbits`.`Category_Product` cp ON p.`product_id` = cp.`categoryProduct_product`;
 */
/*--------------STORED PROCEDURES USER---------------------*/
DROP PROCEDURE IF EXISTS `insertUser`;
DELIMITER $$
CREATE PROCEDURE `insertUser`(
    IN _email           VARCHAR(60),
    IN _username        VARCHAR(60),
    IN _password        VARCHAR(255),
    IN _name            VARCHAR(60),
    IN _lastName        VARCHAR(60),
    IN _birthdate       DATE,
    IN _image           LONGBLOB,
    IN _gender          VARCHAR(60),
    IN _isPublic        TINYINT,
    IN _rol             VARCHAR(60)       
)
BEGIN
    -- Insertar el usuario
    INSERT INTO `bytesandbits`.`User`(
        `user_email`,    
        `user_userName`, 
        `user_password`, 
        `user_name`,     
        `user_lastName`, 
        `user_birthDate`,
        `user_image`,    
        `user_gender`,
        `user_isPublic`,
        `user_rol`      
    ) VALUES (
        _email,    
        _username, 
        _password, 
        _name,     
        _lastName, 
        _birthdate,
        _image,    
        _gender,   
        _isPublic, 
        _rol      
    );

    -- Obtener el ID del usuario recién insertado
    SET @userId = LAST_INSERT_ID();

    -- Insertar un carrito para el usuario
    INSERT INTO `bytesandbits`.`Cart`(
        `cart_user`
    ) VALUES (
        @userId
    );

END $$
DELIMITER ;
/* DROP PROCEDURE IF EXISTS `insertUser`;
DELIMITER $$
CREATE PROCEDURE `insertUser`(
    IN _email           VARCHAR(60),
    IN _username        VARCHAR(60),
    IN _password        VARCHAR(255),
    IN _name            VARCHAR(60),
    IN _lastName        VARCHAR(60),
    IN _birthdate       DATE,
    IN _image           LONGBLOB,
    IN _gender          VARCHAR(60),
    IN _isPublic        TINYINT,
    IN _rol             VARCHAR(60)       
)
BEGIN
    INSERT INTO `bytesandbits`.`User`(
        `user_email`,    
        `user_userName`, 
        `user_password`, 
        `user_name`,     
        `user_lastName`, 
        `user_birthDate`,
        `user_image`,    
        `user_gender`,
        `user_isPublic`,
        `user_rol`      
    )VALUES(
        _email,    
        _username, 
        _password, 
        _name,     
        _lastName, 
        _birthdate,
        _image,    
        _gender,   
        _isPublic, 
        _rol      
    );
END $$
DELIMITER ; */

DROP PROCEDURE IF EXISTS `updateUserByUser`;
DELIMITER $$
CREATE PROCEDURE `updateUserByUser`(
    IN _id				INT,
    IN _password        VARCHAR(255),
    IN _name            VARCHAR(60),
    IN _lastName        VARCHAR(60),
    IN _birthdate       DATE,
    IN _image           LONGBLOB,
    IN _gender          VARCHAR(60),
    IN _isPublic        TINYINT  
)
BEGIN
     UPDATE `bytesandbits`.`User` SET
        `user_password` = COALESCE(NULLIF(_password, ""), `user_password`),
        `user_name` = COALESCE(NULLIF(_name, ""), `user_name`),
        `user_lastName` = COALESCE(NULLIF(_lastName, ""), `user_lastName`),
        `user_birthDate` = COALESCE(NULLIF(_birthdate, NULL), `user_birthDate`),
        `user_image` = COALESCE(NULLIF(_image, ""), `user_image`),
        `user_gender` = COALESCE(NULLIF(_gender, ""), `user_gender`),
        `user_isPublic` = COALESCE(NULLIF(_isPublic, NULL), `user_isPublic`)
    WHERE `user_id`= _id;
END $$
DELIMITER ;

/* #CALL updateUserByUser(1, 'Contraseniax2','Nombre', 'Apellidox2', NULL, NULL, '', 0);*/

DROP PROCEDURE IF EXISTS `updateUserByAdmin`;
DELIMITER $$
CREATE PROCEDURE `updateUserByAdmin`(
    IN _id              INT,
    IN _isEnable        TINYINT     
)
BEGIN
    UPDATE `bytesandbits`.`User`
        SET        
        `user_isEnable` = CASE
            WHEN _isEnable IS NULL OR _isEnable = '' THEN `user_isEnable`
                ELSE _isEnable
            END
    WHERE `user_id`= _id;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `selectOneUser`;
DELIMITER $$
CREATE PROCEDURE `selectOneUser`(
    IN _identification   VARCHAR(60)
)
BEGIN
    DECLARE _userCount INT;

    SELECT COUNT(*) INTO _userCount
    FROM `bytesandbits`.`User`
    WHERE `user_email` = _identification OR `user_userName` = _identification;

    IF _userCount = 1 THEN
        SELECT 
            `user_id`,       
            `user_email`,    
            `user_userName`, 
            `user_password`, 
            `user_name`,     
            `user_lastName`, 
            `user_birthDate`,
            `user_image`,    
            `user_gender`,
            `user_isPublic`, 
            `user_isEnable`, 
            `user_rol`
        FROM  `bytesandbits`.`User`
        WHERE `user_email` = _identification OR `user_userName` = _identification;
    END IF;    
END $$
DELIMITER ;
/*#CALL selectOneUser('nuevo_usuario');*/

DROP PROCEDURE IF EXISTS `checkOneUserExists`;
DELIMITER $$
CREATE PROCEDURE `checkOneUserExists`(
    IN _identification   VARCHAR(60)
)
BEGIN
    DECLARE _userCount INT;

    SELECT COUNT(*) INTO _userCount
    FROM `bytesandbits`.`User`
    WHERE `user_email` = _identification OR `user_userName` = _identification;

    IF _userCount = 1 THEN
        SELECT 'ALREADY EXISTS' AS response;
    ELSE
        SELECT 'NOT EXISTS' AS response;
    END IF;    
END $$
DELIMITER ;
/*CALL checkOneUserExists('nuevo_usuario');*/

DROP PROCEDURE IF EXISTS `checkOneUserEnabled`;
DELIMITER $$
CREATE PROCEDURE `checkOneUserEnabled`(
    IN _identification   VARCHAR(60)
)
BEGIN
    DECLARE _userIsEnable TINYINT;

    SELECT `user_isEnable` INTO _userIsEnable
    FROM `bytesandbits`.`User`
    WHERE `user_email` = _identification OR `user_userName` = _identification;

    IF _userIsEnable = 1 THEN
        SELECT 'ENABLED' AS response;
    ELSE
        SELECT 'DISABLED' AS response;
    END IF;    
END $$
DELIMITER ;

/*CALL checkOneUserEnabled('nuevo_usuario@eample.com');*/

DROP PROCEDURE IF EXISTS `selectAllUser`;
DELIMITER $$
CREATE PROCEDURE `selectAllUser`()
BEGIN
   SELECT 
        `user_id`,       
        `user_email`,    
        `user_userName`, 
        `user_password`, 
        `user_name`,     
        `user_lastName`, 
        `user_birthDate`,
        `user_image`,    
        `user_gender`,
        `user_isPublic`, 
        `user_isEnable`, 
        `user_rol`
    FROM `bytesandbits`.`User`;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `searchUser`;
DELIMITER $$
CREATE PROCEDURE `searchUser`( 
    IN _search  TEXT
    )
BEGIN
    SELECT
        `user_id`, 
        `user_userName`,
        `user_image`,
        `user_isPublic`,
        `user_rol`
    FROM `bytesandbits`.`User` WHERE 
    (_search IS NULL OR `user_userName` LIKE CONCAT("%", _search, "%"))
    AND `user_isEnable` = 1;
END $$
DELIMITER ;



/*---------------STORED PROCEDURE PRODUCT----------------------*/
DROP PROCEDURE IF EXISTS `insertProduct`;
DELIMITER $$
CREATE PROCEDURE `insertProduct`( 
    IN _name                VARCHAR(60),
    IN _description         TEXT,
    IN _image               LONGBLOB,
    IN _quotation           TINYINT,
    IN _price               DECIMAL,
    IN _quantityAvailable   INT,
    IN _user                INT)
BEGIN
   INSERT INTO `bytesandbits`.`Product`(
        `product_name`,    
        `product_description`,
        `product_image`,
        `product_quotation`,     
        `product_price`, 
        `product_quantityAvailable`,
        `product_user`
    )VALUES(
        _name,             
        _description,
        _image,
        _quotation,     
        _price,        
        _quantityAvailable,
        _user 
    );
    /*SELECT LAST_INSERT_ID() as `lastID`;*/
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `insertImage`;
DELIMITER $$
CREATE PROCEDURE `insertImage`( 
    IN _image       LONGBLOB,
    IN _product     INT
    )
BEGIN
   INSERT INTO `bytesandbits`.`Image`(
        `image_content`,    
        `image_product`
    )VALUES(
        _image,             
        _product
    );
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `insertVideo`;
DELIMITER $$
CREATE PROCEDURE `insertVideo`( 
    IN _video       LONGBLOB,
    IN _product     INT
    )
BEGIN
   INSERT INTO `bytesandbits`.`Video`(
        `video_content`,    
        `video_product`
    )VALUES(
        _video,             
        _product
    );
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `modifyProduct`;
DELIMITER $$
CREATE PROCEDURE `modifyProduct`( 
    IN _name                VARCHAR(60),
    IN _description         TEXT,
    IN _image               LONGBLOB,
    IN _quotation           TINYINT,
    IN _price               DECIMAL,
    IN _quantityAvailable   INT,
    IN _isEnable            TINYINT,
    IN _user                INT
    )
BEGIN
    UPDATE `bytesandbits`.`Product` SET
            `product_name` = COALESCE(NULLIF(_name, ""), `product_name`),
            `product_description` = COALESCE(NULLIF(_description, ""), `product_description`),
            `product_image` = COALESCE(NULLIF(_image, ""), `product_image`),
            `product_quotation` = COALESCE(NULLIF(_quotation, NULL), `product_quotation`),
            `product_price` = COALESCE(NULLIF(_price, NULL), `product_price`),
            `product_quantityAvailable` = COALESCE(NULLIF(_quantityAvailable, NULL), `product_quantityAvailable`),
            `product_isEnable` = COALESCE(NULLIF(_isEnable, NULL), `product_isEnable`)
        WHERE `product_id` = _id;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `searchProduct`;
DELIMITER $$
CREATE PROCEDURE `searchProduct`( 
    IN _search TEXT
)
BEGIN
    SELECT * FROM `ProductGeneralInfoView`
    WHERE (_search IS NULL OR 
           `product_name` LIKE CONCAT("%", _search, "%"))
    AND `product_isEnable` = 1;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `selectOneProduct`;
DELIMITER $$
CREATE PROCEDURE `selectOneProduct`( 
    IN _productId INT
)
BEGIN
    SELECT * FROM `ProductSpecificInfoView` WHERE `product_id` = _productId;
END $$
DELIMITER ;

/*-------------------------STORED PROCEDURES QUOTATION---------------------------------------*/
DROP PROCEDURE IF EXISTS `addQuotationBuyerRequest`;
DELIMITER $$
CREATE PROCEDURE `addQuotationBuyerRequest`(    
    IN _specifications  TEXT,
    IN _product         INT,
    IN _user            INT
)
BEGIN
    INSERT INTO `bytesandbits`.`Quotation`(
        `quotation_specifications`,
        `quotation_product`,
        `quotation_user`
    )VALUES(
        _specifications,
        _product,
        _user
    );
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `modifyQuotationSellerResponse`;
DELIMITER $$
CREATE PROCEDURE `modifyQuotationSellerResponse`(
    IN _id              INT,
    IN _expirationDate  DATETIME,    
    IN _priceAgreed     DECIMAL(10,10)
)
BEGIN
    UPDATE `bytesandbits`.`Quotation` SET
        `quotation_expirationDate` =  COALESCE(NULLIF(_expirationDate, NULL), `quotation_expirationDate`),
        `quotation_priceAgreed` = COALESCE(NULLIF(_priceAgreed, NULL), `quotation_priceAgreed`)
    WHERE `quotation_id` = _id;
END $$
DELIMITER ;


DROP PROCEDURE IF EXISTS `getAllQuotationOneSeller`;
DELIMITER $$
CREATE PROCEDURE `getAllQuotationOneSeller`(
    IN _idUser              INT    
)
BEGIN
    SELECT * FROM `SellerQuotationView` WHERE `product_user` = _idUser;
END $$
DELIMITER ;


DROP PROCEDURE IF EXISTS `getAllQuotationOneBuyer`;
DELIMITER $$
CREATE PROCEDURE `getAllQuotationOneBuyer`(
    IN _idUser              INT    
)
BEGIN
    SELECT * FROM `BuyerQuotationView` WHERE `product_user` = _idUser    
    GROUP BY u.`user_id`, p.`product_id`;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `deleteLogicalQuotation`;
DELIMITER $$
CREATE PROCEDURE `deleteLogicalQuotation`(
    IN _idQuotation             INT    
)
BEGIN
    UPDATE `bytesandbits`.`Quotation` SET
        `product_isEnable` = 0
    WHERE `product_id` = _idQuotation;
END $$
DELIMITER ;

/*-----------------------------------STORED PROECURE LIST-----------------------------------*/
DROP PROCEDURE IF EXISTS `addList`;
DELIMITER $$
CREATE PROCEDURE `addList`(
    IN _name            VARCHAR(60),
    IN _description     TEXT,
    IN _isPublic        TINYINT,
    IN _userOwner       INT
)
BEGIN
    INSERT INTO `bytesandbits`.`List`(
        `list_name`, 
        `list_description`,
        `list_isPublic`,
        `list_user`
    )VALUES(
        _name,
        _description,
        _isPublic,
        _userOwner
    );
    /*SELECT LAST_INSERT_ID() as `lastID`;*/
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `addImageList`;
DELIMITER $$
CREATE PROCEDURE `addImageList`(
    IN _image       LONGBLOB,
    IN _idList      INT
)
BEGIN
    INSERT INTO `bytesandbits`.`imageList`(
        `imageList_content`, 
        `imageList_list`
    )VALUES(
        _image,
        _idList
    );
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `addProductToList`;
DELIMITER $$
CREATE PROCEDURE `addProductToList`(
    IN _idList      INT,
    IN _idProduct   INT
)
BEGIN
    INSERT INTO `bytesandbits`.`List_Product`(
        `listProduct_list`, 
        `listProduct_product`
    )VALUES(
        _idList,
        _idProduct
    );
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `modifyList`;
DELIMITER $$
CREATE PROCEDURE `modifyList`(
    IN _id              INT,
    IN _name            VARCHAR(60),
    IN _description     TEXT,
    IN _isPublic        TINYINT
)
BEGIN
    UPDATE `bytesandbits`.`List` SET
        `list_name` = COALESCE(NULLIF(_name, ""), `list_name`),
        `list_description` = COALESCE(NULLIF(_description, ""), `list_description`),
        `list_isPublic` = COALESCE(NULLIF(_isPublic, ""), `list_isPublic`)
    WHERE `list_id` = _id;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `getListByName`;
DELIMITER $$
CREATE PROCEDURE `getListByName`(
    IN _name            VARCHAR(60)
)
BEGIN
    SELECT * FROM CompleteList
    WHERE (_name IS NULL OR `bytesandbits`.`List`.`list_name` LIKE CONCAT("%", _name, "%"))
    AND `bytesandbits`.`List`.`list_isEnable` = 1;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `getListByUser`;
DELIMITER $$
CREATE PROCEDURE `getListByUser`(
    IN _user    INT
)
BEGIN
    SELECT * FROM CompleteList
    WHERE `bytesandbits`.`List`.`list_user` = _user
    AND `bytesandbits`.`List`.`list_isEnable` = 1;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `deleteLogicalList`;
DELIMITER $$
CREATE PROCEDURE `deleteLogicalList`(
    IN _id  INT
)
BEGIN
    UPDATE `bytesandbits`.`List` SET
        `list_isEnable` = 0
    WHERE `list_id` = _id;
END $$
DELIMITER ;

/*--------------------------STORED PROCEDURE CATEGORY----------------------------------*/
DROP PROCEDURE IF EXISTS `addCategory`;
DELIMITER $$
CREATE PROCEDURE `addCategory`(
    IN _name            VARCHAR(60),
    IN _description     TEXT,
    IN _userOwner       INT
)
BEGIN
    INSERT INTO `bytesandbits`.`Category`(
        `category_name`, 
        `category_description`,
        `category_user`
    )VALUES(
        _name,
        _description,
        _userOwner
    );
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `addProductInCategory`;
DELIMITER $$
CREATE PROCEDURE `addProductInCategory`(
    IN _idProduct       INT,
    IN _idCategory       INT
)
BEGIN
    INSERT INTO `bytesandbits`.`Category_Product`(
        `categoryProduct_product`, 
        `categoryProduct_category`
    )VALUES(
        _idProduct,
        _idCategory
    );
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `modifyCategory`;
DELIMITER $$
CREATE PROCEDURE `modifyCategory`(
    IN _id              INT,
    IN _name            VARCHAR(60),
    IN _description     TEXT,
    IN _isEnable        TINYINT
)
BEGIN
    UPDATE `bytesandbits`.`Category` SET
        `category_name` = COALESCE(NULLIF(_name, ""), `category_name`),
        `category_description` = COALESCE(NULLIF(_description, ""), `category_description`),
        `category_isEnable` = _isEnable
    WHERE `category_id` = _id;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `getAllCategories`;
DELIMITER $$
CREATE PROCEDURE `getAllCategories`(
)
BEGIN
    SELECT 
        `category_id`,
        `category_name`,
        `category_description`
    FROM `bytesandbits`.`Category`;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `getProductByCategory`;
DELIMITER $$
CREATE PROCEDURE `getProductByCategory`(
    IN _idCategory INT
)
BEGIN
    SELECT
        p.`product_id`,
        p.`product_name`,
        p.`product_image`
    FROM `bytesandbits`.`Product` p
    JOIN `bytesandbits`.`Category_Product` cp ON p.`product_id` = cp.`categoryProduct_product`
    WHERE cp.`categoryProduct_category` = _idCategory;
END $$
DELIMITER ;

/*----------------------------------------STORED PROCEDURE RATING----------------------*/
DROP PROCEDURE IF EXISTS `addRating`;
DELIMITER $$
CREATE PROCEDURE `addRating`(
    IN _score       INT,
    IN _comment     TEXT,
    IN _product     INT,
    IN _user        INT
)
BEGIN
    INSERT INTO `bytesandbits`.`Rating`(
        `rating_score`,
        `rating_comment`,
        `rating_product`,
        `rating_user`
    )VALUES(
        _score,
        _comment,
        _product,
        _user
    );
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `modifyRating`;
DELIMITER $$
CREATE PROCEDURE `modifyRating`(
    IN _idRating    INT,
    IN _score       INT,
    IN _comment     TEXT,
    IN _isEnable    TINYINT,
    IN _user        INT
)
BEGIN
    UPDATE `bytesandbits`.`Rating` SET
        `rating_score`      =   COALESCE(NULLIF(CASE WHEN _score = 0 THEN NULL ELSE _score END, `rating_score`), `rating_score`),
        `rating_comment`    =   COALESCE(NULLIF(_comment, ""), `rating_comment`),
        `rating_isEnable`   =   _isEnable
    WHERE `rating_id` = _idRating AND `rating_user` = _user;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `getRatingByUser`;
DELIMITER $$
CREATE PROCEDURE `getRatingByUser`(
    IN _user       INT
)
BEGIN
    SELECT 
        `rating_id`,      
        `rating_score`,  
        `rating_comment`, 
        `rating_isEnable`,
        `rating_product`
    FROM `bytesandbits`.`Rating`
    WHERE `rating_user` = _user;
END $$
DELIMITER ;

/*------------------------------STORED PROCEDURE CART---------------------*/

DROP PROCEDURE IF EXISTS `addProductInCart`;
DELIMITER $$
CREATE PROCEDURE `addProductInCart`(
    IN _quantity    INT,
    IN _product     INT,
    IN _cart        INT
)
BEGIN
    INSERT INTO `bytesandbits`.`Cart_Item`(
        `cartItem_quantity`,
        `cartItem_product`,
        `cartItem_cart`    
    )VALUES(
        _quantity,
        _product,
        _cart    
    );
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `getCartByUser`;
DELIMITER $$
CREATE PROCEDURE `getCartByUser`(
    IN _idUser       INT
)
BEGIN
    SELECT
        `cart_id`
    FROM `bytesandbits`.`Cart`
    WHERE `cart_user` = _idUser;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `getProductsInCart`;
DELIMITER $$
CREATE PROCEDURE `getProductsInCart`(
    IN _idCart       INT
)
BEGIN
    SELECT
        p.`product_id`,
        p.`product_name`,
        p.`product_image`,
        ci.`cartItem_quantity`,
        ci.`cartItem_cart`
    FROM `bytesandbits`.`Product` p
    INNER JOIN `bytesandbits`.`Cart_Item` ci ON p.`product_id` = ci.`cartItem_product`
    WHERE ci.`cartItem_cart` = _idCart AND ci.`cartItem_isEnable` = 1;
END $$
DELIMITER ;

/*--------------------------------------STORED PROCEDURE CONVERSATION-------------------*/
DROP PROCEDURE IF EXISTS `addConversation`;
DELIMITER $$
CREATE PROCEDURE `addConversation`(
    IN _seller    INT,
    IN _buyer     INT,
    IN _product   INT
)
BEGIN
    INSERT INTO `bytesandbits`.`Conversation`(
        `conversation_seller`,
        `conversation_buyer`,
        `conversation_product`
    )VALUES(
        _seller,
        _buyer,
        _product
    );
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `addMessage`;
DELIMITER $$
CREATE PROCEDURE `addMessage`(
    IN _text            TEXT,
    IN _conversation    INT,
    IN _sender          INT
)
BEGIN
    INSERT INTO `bytesandbits`.`Message`(
        `message_text`,
        `message_conversation`,
        `message_sender`
    )VALUES(
        _text,
        _conversation,
        _sender
    );
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `getConversationsSeller`;
DELIMITER $$
CREATE PROCEDURE `getConversationsSeller`(
    IN _seller  INT
)
BEGIN
    SELECT 
        `conversation_id`,
        `conversation_seller`,
        `conversation_buyer`,
        `conversation_product`
    FROM `bytesandbits`.`Conversation`
    WHERE `conversation_seller` = _seller
    AND `conversation_isEnable` = 1;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `getConversationsBuyer`;
DELIMITER $$
CREATE PROCEDURE `getConversationsBuyer`(
    IN _buyer  INT
)
BEGIN
    SELECT 
        `conversation_id`,
        `conversation_seller`,
        `conversation_buyer`,
        `conversation_product`
    FROM `bytesandbits`.`Conversation`
    WHERE `conversation_buyer` = _buyer
    AND `conversation_isEnable` = 1;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `getAllMessages`;
DELIMITER $$
CREATE PROCEDURE `getAllMessages`(
    IN _idConversation  INT
)
BEGIN
    SELECT cmv.*
    FROM ChatMessagesView cmv
    INNER JOIN `bytesandbits`.`Conversation` c on c.`conversation_id` = _idConversation
    WHERE cmv.`message_conversation` = _idConversation
    AND (cmv.`sender_id` = c.`conversation_seller` OR cmv.`sender_id` = c.`conversation_buyer`)
    ORDER BY cmv.`message_date`;
END $$
DELIMITER ;

/*---------------------------------STORED PROCEDURES COMPRA Y VENTA-------------------------*/
DROP PROCEDURE IF EXISTS `addTransaction`;
DELIMITER $$
CREATE PROCEDURE `addTransaction`(
    IN _productId INT,
    IN _sellerId INT,
    IN _buyerId INT
)
BEGIN    
        INSERT INTO `bytesandbits`.`Sale`(`sale_product`, `sale_seller`) VALUES (_productId, _sellerId);   
        INSERT INTO `bytesandbits`.`Purchase`(`purchase_product`, `purchase_buyer`) VALUES (_productId, _buyerId);
    
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `GetSalesDetails`;
DELIMITER $$
CREATE PROCEDURE `GetSalesDetails`(
    IN _idSeller        INT,
    IN _startDate       DATE,
    IN _endDate         DATE,
    IN _categoryFilter  INT
)
BEGIN
    SELECT *
    FROM SalesDetailsView
    WHERE
        `sale_seller` = _idSeller AND
        (_startDate IS NULL OR `sale_date` >= _startDate)
        AND (_endDate IS NULL OR `sale_date` <= _endDate)
        AND (_categoryFilter IS NULL OR `category_id` = _categoryFilter);
END$$
DELIMITER ;

DROP PROCEDURE IF EXISTS `GetSalesGrouped`;
DELIMITER $$
CREATE PROCEDURE `GetSalesGrouped`(
    IN _idSeller        INT,
    IN _startDate       DATE,
    IN _endDate         DATE,
    IN _categoryFilter  INT
)
BEGIN
    SELECT *
    FROM SalesGroupedView
    WHERE
        `sale_seller` = _idSeller AND
        (_startDate IS NULL OR `sale_date` >= _startDate)
        AND (_endDate IS NULL OR `sale_date` <= _endDate)
        AND (_categoryFilter IS NULL OR `category_id` = _categoryFilter);
END$$
DELIMITER ;

DROP PROCEDURE IF EXISTS `GetPurchasesDetails`;
DELIMITER $$
CREATE PROCEDURE `GetPurchasesDetails`(
    IN _idBuyer         INT,
    IN _startDate       DATE,
    IN _endDate         DATE,
    IN _categoryFilter  INT
)
BEGIN
    SELECT *
    FROM PurchasesDetailsView
    WHERE
        `purchase_buyer` = _idBuyer AND
        (_startDate IS NULL OR `sale_date` >= _startDate)
        AND (_endDate IS NULL OR `sale_date` <= _endDate)
        AND (_categoryFilter IS NULL OR `category_id` = _categoryFilter);
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `GetPurchasesGrouped`;
DELIMITER $$
CREATE PROCEDURE `GetPurchasesGrouped`(
    IN _idBuyer         INT,
    IN _startDate       DATE,
    IN _endDate         DATE,
    IN _categoryFilter  INT
)
BEGIN
    SELECT *
    FROM PurchasesGroupedView
    WHERE
        `purchase_buyer` = _idBuyer AND
        (_startDate IS NULL OR `sale_date` >= _startDate)
        AND (_endDate IS NULL OR `sale_date` <= _endDate)
        AND (_categoryFilter IS NULL OR `category_id` = _categoryFilter);
END$$
DELIMITER ;

/* DROP PROCEDURE IF EXISTS `addSale`;
DELIMITER $$
CREATE PROCEDURE `addSale`(
    IN _productId INT,
    IN _sellerId INT
)
BEGIN
    INSERT INTO `bytesandbits`.`Sale`(
        `sale_product`,
        `sale_seller`
    )VALUES(
        _productId,
        _sellerId
    );
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS `addPurchase`;
DELIMITER $$
CREATE PROCEDURE `addPurchase`(
    IN _productId INT,
    IN _buyerId INT
)
BEGIN
    INSERT INTO `bytesandbits`.`Purchase`(
        `sale_product`,
        `sale_seller`
    )VALUES(
        _productId,
        _buyerId
    );
END $$
DELIMITER ; */


/*----------------------------------FUNCIONES--------------------------------------------*/

DELIMITER $$
CREATE FUNCTION averageProductRatings(_productId INT) RETURNS DECIMAL
READS SQL DATA
BEGIN
    DECLARE avgRating DECIMAL;
    SELECT AVG(`rating_score`) INTO avgRating
    FROM `bytesandbits`.`Rating`
    WHERE `rating_product` = _productId;
    RETURN COALESCE(avgRating, 0);
END$$
DELIMITER ;

DELIMITER $$
CREATE FUNCTION productInCart(_userId INT, _productId INT) RETURNS BOOLEAN
READS SQL DATA
BEGIN
    DECLARE isInCart BOOLEAN;
    SELECT EXISTS (
        SELECT 1
        FROM `bytesandbits`.`Cart_Item` ci
        WHERE ci.`cartItem_user` = _userId AND ci.`cartItem_product` = _productId AND ci.`cartItem_isEnable` = 1
    ) INTO isInCart;
    RETURN isInCart;
END $$
DELIMITER ;
/* DELIMITER $$
CREATE FUNCTION averageProductRatings(_productId INT) RETURNS DECIMAL
BEGIN
    DECLARE avgRating DECIMAL;
    SELECT AVG(`rating_score`) INTO avgRating
    FROM `bytesandbits`.`Rating`
    WHERE `rating_product` = _productId;
    RETURN COALESCE(avgRating, 0);
END$$;
DELIMITER;

DELIMITER $$
CREATE FUNCTION productInCart(_userId INT, _productId INT) RETURNS BOOLEAN
BEGIN
    DECLARE isInCart BOOLEAN;
    SELECT EXISTS (
        SELECT 1
        FROM `bytesandbits`.`Cart_Item` ci
        WHERE ci.`cartItem_user` = _userId AND ci.`cartItem_product` = _productId AND ci.`cartItem_isEnable` = 1
    ) INTO isInCart;
    RETURN isInCart;
END$$;
DELIMITER; */
/*----------------------------------------TRIGGERS----------------------------------------*/

CREATE TRIGGER approveProduct
BEFORE INSERT ON `bytesandbits`.`adminMovements`
FOR EACH ROW
UPDATE `bytesandbits`.`Product` SET
        `product_isApproved` = 1
    WHERE `product_id` = NEW.`adminMovements_idProduct`;
    
CREATE TRIGGER disableProductOnZeroQuantity
BEFORE UPDATE ON `bytesandbits`.`Product`
FOR EACH ROW
SET NEW.`product_isEnable` = IF(NEW.`product_quantityAvailable` > 0, 1, 0);

CREATE TRIGGER closeConversationOnSale
AFTER INSERT ON `bytesandbits`.`Sale`
FOR EACH ROW
    UPDATE `bytesandbits`.`Conversation`
    SET `conversation_isEnable` = 0
    WHERE `conversation_product` = NEW.`sale_product`;

    
    
/* 

CREATE TRIGGER approveProduct
BEFORE INSERT ON `bytesandbits`.`adminMovements`
FOR EACH ROW
UPDATE `bytesandbits`.`Product` SET
        `product_isApproved` = 1
    WHERE `product_id` = NEW.`adminMovements_idProduct`;
    
CREATE TRIGGER disableProductOnZeroQuantity
BEFORE UPDATE ON `bytesandbits`.`Product`
FOR EACH ROW
SET NEW.`product_isEnable` = IF(NEW.`product_quantityAvailable` > 0, 1, 0);

CREATE TRIGGER closeConversationOnSale
AFTER INSERT ON `bytesandbits`.`Sale`
FOR EACH ROW
BEGIN
    UPDATE `bytesandbits`.`Conversation`
    SET `conversation_isEnable` = 0
    WHERE `conversation_product` = NEW.`sale_product`;
END; 

*/

