ALTER TABLE Actividades
ADD COLUMN Lider_CI INT,
ADD COLUMN Lider_Certificacion_CI INT,
ADD CONSTRAINT FK_Lider_CI FOREIGN KEY (Lider_CI) REFERENCES
Lideres_de_grupo(CI),
ADD CONSTRAINT FK_Lider_Certificacion_CI FOREIGN KEY (Lider_Certificacion_CI)
REFERENCES Certificacion(CI);