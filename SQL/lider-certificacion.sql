CREATE INDEX idx_CI ON Certificacion(CI_Lider);
ALTER TABLE Lideres_de_grupo
ADD CONSTRAINT FK_Certificacion_CI FOREIGN KEY (Certificacion_CI) REFERENCES
Certificacion(CI_Lider);