ALTER TABLE Campamentos
ADD COLUMN Actividades_idActividades INT,
ADD COLUMN Actividades_Cliente_Numero_cliente INT,
ADD CONSTRAINT FK_Actividades_idActividades_Campamentos FOREIGN KEY
(Actividades_idActividades) REFERENCES Actividades(Identificador),
ADD CONSTRAINT FK_Actividades_Cliente_Numero_cliente_Campamentos FOREIGN
KEY (Actividades_Cliente_Numero_cliente) REFERENCES Actividades(Cliente_Numero_cliente);

ALTER TABLE Deportes
ADD COLUMN Actividades_idActividades INT,
ADD COLUMN Actividades_Cliente_Numero_cliente INT,
ADD CONSTRAINT FK_Actividades_idActividades_Deportes FOREIGN KEY
(Actividades_idActividades) REFERENCES Actividades(Identificador),
ADD CONSTRAINT FK_Actividades_Cliente_Numero_cliente_Deportes FOREIGN KEY
(Actividades_Cliente_Numero_cliente) REFERENCES Actividades(Cliente_Numero_cliente);

ALTER TABLE Juegos
ADD COLUMN Actividades_idActividades INT,
ADD COLUMN Actividades_Cliente_Numero_cliente INT,
ADD CONSTRAINT FK_Actividades_idActividades_Juegos FOREIGN KEY
(Actividades_idActividades) REFERENCES Actividades(Identificador),
ADD CONSTRAINT FK_Actividades_Cliente_Numero_cliente_Juegos FOREIGN KEY
(Actividades_Cliente_Numero_cliente) REFERENCES Actividades(Cliente_Numero_cliente);