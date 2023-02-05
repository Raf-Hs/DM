    create DATABASE luran;
    use luran;


    create table sucursal(
    id int auto_increment,
    ciudad char(30) not null,
    CONSTRAINT primary key(id));
    
  INSERT INTO `sucursal`(`id`, `ciudad`) VALUES ('','Monterrey');
  INSERT INTO `sucursal`(`id`, `ciudad`) VALUES ('','Guadalajara'); 
  INSERT INTO `sucursal`(`id`, `ciudad`) VALUES ('','Querétaro'); 
  INSERT INTO `sucursal`(`id`, `ciudad`) VALUES ('0','Almacen');

    create TABLE usuarios( 
    id int auto_increment,
    usuario VARCHAR(20) not null,
    contrasenia varchar(25) not NULL,
    tipo CHAR(30) not null,
    activo int (2) not null,
    CONSTRAINT PRIMARY key(id));

  INSERT INTO `usuarios` (`id`, `usuario`, `contrasenia`, `tipo`, `activo`) VALUES (NULL, 'Admin Mon', '123m', '1', '1');
  INSERT INTO `usuarios` (`id`, `usuario`, `contrasenia`, `tipo`, `activo`) VALUES (NULL, 'Admin GDJ', '123g', '1', '1');
  INSERT INTO `usuarios` (`id`, `usuario`, `contrasenia`, `tipo`, `activo`) VALUES (NULL, 'Admin Qro', '123q', '1', '1');

  INSERT INTO `usuarios` (`id`, `usuario`, `contrasenia`, `tipo`, `activo`) VALUES (NULL, 'Cliente 1', '123', '2', '1'); 

  create table factura(
    id int auto_increment,
    fecha date not Null,
    CONSTRAINt PRIMARY key(id));

    create table producto(
    ID int (11) auto_increment,
    Nombre char(255)  null,
    Precio decimal (20,2) NULL,
    Descripcion text NULL,
    Imagen varchar (255) Null,
    Activo int (11) Null,
    CONSTRAINT PRIMARY KEY(id));


  INSERT INTO `producto` (`id`, `nombre`, `precio`, `descripcion`, `imagen`, `activo`) VALUES (NULL, 'Fuente de Poder', '600.00', 'Es una fuente de poder ', NULL, '1');
  INSERT INTO `producto` (`id`, `nombre`, `precio`, `descripcion`, `imagen`, `activo`) VALUES (NULL, 'RAM', '305.50', 'Es una ', NULL, '1');
  INSERT INTO `producto` (`id`, `nombre`, `precio`, `descripcion`, `imagen`, `activo`) VALUES (NULL, 'Audifonos', '50.00', 'Son unos audifonos ', NULL, '1');

  create table cliente(
    id int auto_increment, 
    nombre char(35) not Null,
    apellidoM char(15) not NULL,
    apellidoP char(15) not NULL,
    telefono char(30) not NULL,
    mail CHAR(30) not NULL,
    ciudad char(30) not NULL,
    exterior CHAR(30) not NULL,
    interior CHAR(30) not NULL,
    colonia char(30) not NULL,
    calle  CHAR(30) not NULL,
    cp CHAR(30) not NULL,
    rfc CHAR(30) not null,
    domf char (30),
    id_usu int not null, 
    CONSTRAINT PRIMARY key(id),
    CONSTRAINT FOREIGN key(id_usu) references usuarios(id));

    create table inventario( 
    id  int auto_increment,
    id_suc int, //Default 0
    id_pro int,
    stock int not NULL,
    CONSTRAINT PRIMARY KEY(id),
    CONSTRAINT FOREIGN key(id_suc) REFERENCES sucursal(id),
    CONSTRAINT foreign key(id_pro) REFERENCES producto(id)); 



  INSERT INTO `inventario` (`id`, `id_suc`, `id_pro`, `stock`) VALUES (NULL, '1', '1', '20');
  INSERT INTO `inventario` (`id`, `id_suc`, `id_pro`, `stock`) VALUES (NULL, '1', '2', '30');
  INSERT INTO `inventario` (`id`, `id_suc`, `id_pro`, `stock`) VALUES (NULL, '1', '3', '2');

 

  INSERT INTO `inventario` (`id`, `id_suc`, `id_pro`, `stock`) VALUES (NULL, '2', '1', '200');
  INSERT INTO `inventario` (`id`, `id_suc`, `id_pro`, `stock`) VALUES (NULL, '2', '2', '35');
  INSERT INTO `inventario` (`id`, `id_suc`, `id_pro`, `stock`) VALUES (NULL, '2', '3', '0');

 

  INSERT INTO `inventario` (`id`, `id_suc`, `id_pro`, `stock`) VALUES (NULL, '3', '1', '10');
  INSERT INTO `inventario` (`id`, `id_suc`, `id_pro`, `stock`) VALUES (NULL, '3', '2', '10');
  INSERT INTO `inventario` (`id`, `id_suc`, `id_pro`, `stock`) VALUES (NULL, '3', '3', '10');


  create table venta(
     `ID` int(11) NOT NULL auto_increment,
    `ClaveTransaccion` varchar(250) NOT NULL,
    `PaypalDatos` text NOT NULL,
  `Fecha` datetime NOT NULL,
    id_clie int,
    `Total` decimal(60,2) NOT NULL,
  `status` varchar(200) NOT NULL,
    id_fac int Null,
    

    CONSTRAINt PRIMARY key(id),
    CONSTRAINT FOREIGN key(id_clie) references cliente(id),
    CONSTRAINT FOREIGN key(id_fac) references factura(id));


      create table det_vta(
   `ID` int(11) NOT NULL auto_increment,
  `IDVENTA` int(11) NOT NULL,
   `IDINVENTARIO` int(11) NOT NULL,
   `PRECIOUNITARIO` decimal(20,2) NOT NULL,
  `CANTIDAD` int(11) NOT NULL,
    CONSTRAINt PRIMARY key(id),
    CONSTRAINT FOREIGN key(IDVENTA) references venta (ID),
    CONSTRAINT FOREIGN key(IDINVENTARIO) references inventario (id));

    
  
  INSERT INTO `cliente` (`id`, `nombre`, `apellidoM`, `apellidoP`, `telefono`, `mail`, `ciudad`, `exterior`, `interior`, `colonia`, `calle`, `cp`, `rfc`, `domf`, `id_usu`) VALUES (NULL, '2', '2', '2', '2', '2@gmail.com', '2', '2', '2', '2', '2', '2', '2', '2', '3');
  
Create trigger stock
after Insert on det_vta
for each row 
Update inventario set stock=stock - new.CANTIDAD where ID = new.idinventario;



  create trigger cliente
  after insert on usuarios
  for each row
  insert into cliente (id_usu) values (new.id);



  create trigger factura
  after insert on venta
  for each row
  insert into factura (id) values (new.id);

create trigger inventario
after insert on producto
for each row
insert into inventario (id_pro) values (new.id);


SOLO USAR LOS DE ARRIBA
SOLO USAR LOS DE ARRIBA
SOLO USAR LOS DE ARRIBA
SOLO USAR LOS DE ARRIBA
SOLO USAR LOS DE ARRIBA
SOLO USAR LOS DE ARRIBA
SOLO USAR LOS DE ARRIBA


 /* 
create trigger inventario
after insert on producto
for each row
insert into inventario (id_pro) values (new.id) 
and insert into inventario (id_suc) values (0)  ;

create trigger stock
after update on venta where status="completo"
for each row
if{
  stock
}

insert into inventario (id_pro) values (new.id);
*/

foreach

DELIMITER $$
CREATE PROCEDURE actualizarStock( id int, cantidad INT)
BEGIN 
    DECLARE stProd INT;
    DECLARE stActual INT; /*stock actual*/

    SET stProd = (SELECT getStock(id));
    SET stActual = stProd - cantidad;

    UPDATE inventario SET stock = stActual WHERE id=inventario.id;
END $$
DELIMITER ;

 



DELIMITER $$
CREATE FUNCTION getStock(id INT) RETURNS INT DETERMINISTIC
BEGIN 
    DECLARE stProd INT;

    SET stProd = (SELECT stock FROM inventario WHERE id = inventario.id);

    RETURN stProd;
END $$
DELIMITER ;

//Aregglos
Las validaciones de stock*
Procedure de stock*
Se muestra por inventario*
Administra por inventario
Identifica las id

/*
                $host="localhost";

        $user="root";

        $password="";

        $db="luran";



                $sqlStock= ("select stock from inventario where id='$ID");
                $StockSelect = mysqli_query($pdo, $sqlStock);

                $dataSelect = mysqli_fetch_array($StockSelect);

                echo $dataSelect["stock"];


                $stock= $dataSelect["stock"];

                echo $stock;
*/