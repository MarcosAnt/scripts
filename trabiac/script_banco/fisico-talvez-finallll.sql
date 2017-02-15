CREATE TABLE usuario(
idusuario SERIAL PRIMARY KEY,
nome_usuario VARCHAR(80),
senha_usuario VARCHAR(100),
rg VARCHAR(9),
cpf VARCHAR(11),
passaporte VARCHAR(11),
data_nasc DATE,
sexo VARCHAR(9),
email VARCHAR(45),
fone_contato1 VARCHAR(11),
fone_contato2 VARCHAR(11),
fone_emergencia1 VARCHAR(11),
nome_contato1 VARCHAR(80),
parentesco_contato1 VARCHAR(45)
);

CREATE TABLE maratona(
idmaratona SERIAL PRIMARY KEY,
idproprietario INTEGER,
datahora TIMESTAMP WITHOUT TIME ZONE,
nome_evento VARCHAR(45),
cidade VARCHAR(20),
estado VARCHAR(2),
local_saida VARCHAR(45),
local_chegada VARCHAR(45),
fone_contato VARCHAR(11),
data_fim_inscr TIMESTAMP WITHOUT TIME ZONE,
percurso VARCHAR(4),
FOREIGN KEY (idproprietario) REFERENCES usuario (idusuario)
);

CREATE TABLE kits(
idkit INTEGER PRIMARY KEY,
descr_kit VARCHAR(85),
valor_kit FLOAT
);

CREATE TABLE modalidade(
idmodalidade INTEGER PRIMARY KEY,
descr VARCHAR(45)
);

CREATE TABLE usuario_maratona(
idinscr SERIAL PRIMARY KEY,
idusuario INTEGER,
idmaratona INTEGER,
modalidade INTEGER,
kit INTEGER,
hora_inicio TIME,
hora_termino TIME,
FOREIGN KEY (idusuario) REFERENCES usuario (idusuario),
FOREIGN KEY (idmaratona) REFERENCES maratona (idmaratona),
FOREIGN KEY (kit) REFERENCES kits (idkit),
FOREIGN KEY (modalidade) REFERENCES modalidade (idmodalidade)
);
