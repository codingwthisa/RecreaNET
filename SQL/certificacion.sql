CREATE TABLE Certificacion (
Codigo VARCHAR(50) PRIMARY KEY,
Fecha DATE,
Grado VARCHAR(50),
Asociacion VARCHAR(100)
);

ALTER TABLE Certificacion
ADD CONSTRAINT fk_asociacion
FOREIGN KEY (Asociacion) REFERENCES Asociacion(Nombre);
