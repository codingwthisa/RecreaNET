ALTER TABLE Actividades
ADD COLUMN Cliente_Numero_cliente INT,
ADD CONSTRAINT FK_Cliente_Numero_cliente FOREIGN KEY (Cliente_Numero_cliente)
REFERENCES Cliente(Numero_cliente);