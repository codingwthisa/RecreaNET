CREATE INDEX idx_Nombre ON Asociacion(Nombre);
ALTER TABLE Colonias
ADD COLUMN Asociacion_Nombre VARCHAR(100),
ADD CONSTRAINT FK_Asociacion_Nombre FOREIGN KEY (Asociacion_Nombre) REFERENCES Asociacion(Nombre);