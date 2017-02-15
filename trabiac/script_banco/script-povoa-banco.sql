CREATE TABLE usuario(
idusuario INTEGER PRIMARY KEY,
nome_usuario VARCHAR(45),
senha_usuario VARCHAR(45),
pnome VARCHAR(12),
mnome VARCHAR(12),
unome VARCHAR(12),
rg VARCHAR(9),
cpf VARCHAR(11),
data_nasc DATE,
email VARCHAR(45),
fone_contato1 VARCHAR(11),

fone_contato2 VARCHAR(11),
fone_emergencia1 VARCHAR(11),
nome_contato1 VARCHAR(45),
parentesco_contato1 VARCHAR(45),
fone_emergencia2 VARCHAR(11),
nome_contato2 VARCHAR(45),
parentesco_contato2 VARCHAR(45)
);


CREATE TABLE maratona(
idmaratona INTEGER PRIMARY KEY,
idproprietario INTEGER,
datahora TIMESTAMP WITH TIME ZONE,
nome_evento VARCHAR(45),
cidade VARCHAR(20),
estado VARCHAR(2),
local_saida VARCHAR(45),
local_chegada VARCHAR(45),
hora_estm_termino TIME,
fone_contato VARCHAR(11),
data_fim_inscr TIMESTAMP WITH TIME ZONE,
FOREIGN KEY (idproprietario) REFERENCES usuario (idusuario)
);



CREATE TABLE forma_pgto(
idforma_pgto INTEGER PRIMARY KEY,
descr_pgto VARCHAR(45)
);


CREATE TABLE kits(
idkit INTEGER PRIMARY KEY,
descr_kit VARCHAR(45),
valor_kit FLOAT
);


CREATE TABLE usuario_maratona(
idinscr INTEGER PRIMARY KEY,
idusuario INTEGER,
idmaratona INTEGER,
forma_pgto INTEGER,
kit INTEGER,
hora_inicio TIME,
hora_termino TIME,
FOREIGN KEY (idusuario) REFERENCES usuario (idusuario),
FOREIGN KEY (idmaratona) REFERENCES maratona (idmaratona),
FOREIGN KEY (forma_pgto) REFERENCES forma_pgto (idforma_pgto),
FOREIGN KEY (kit) REFERENCES kits (idkit)
);


CREATE TABLE passaporte_usuario(
numpassaporte INTEGER PRIMARY KEY,
usuario INTEGER,
FOREIGN KEY (usuario) REFERENCES usuario (idusuario)
);


CREATE TABLE modalidade(
idmodalidade INTEGER PRIMARY KEY,
descr VARCHAR(45)
);


CREATE TABLE usr_mrtna_mdlde(
usuario INTEGER,
maratona INTEGER,
modalidade INTEGER,
FOREIGN KEY (usuario) REFERENCES usuario (idusuario),
FOREIGN KEY (maratona) REFERENCES maratona (idmaratona),
FOREIGN KEY (modalidade) REFERENCES modalidade (idmodalidade)
);







insert into usuario values (1, 'VilsonGatinho', 'vilson1234', 'Vilson', 'de', 'Souza', 987654321, 99987654321, '1980-01-01', 'vilsonzinho@goo.cof', '33333333333', '44444444444', '55555555555', 'Vilma', 'esposa', '66666666666', 'carlos', 'irmão');  




insert into maratona values (1, 1, timestamp '2016-12-13 16:00' - interval '3 hours', 'Maratona beneficente São João', 'Curitiba', 'pr', 'Rua XV de Novembro', 'Boca Maldita', time '18:00' - interval '3 hours', '33333333333', timestamp '2016-12-10 16:00' - interval '3 hours');

insert into maratona values (2, 1, timestamp '2017-02-10 16:00' - interval '3 hours', 'Maratona da Capela de Cuiabá', 'Cuiabá', 'MT', 'Rua do mato grosso', 'Rua final do mato grosso', time '18:00' - interval '3 hours', '33333333333', timestamp '2017-02-09 16:00' - interval '3 hours');

insert into maratona values (3, 1, timestamp '2017-04-04 16:00' - interval '3 hours', 'Maratona do estado de São Paulo', 'São Paulo', 'SP', 'Rua de São Paulo', 'Rua final de São Paulo', time '18:00' - interval '3 hours', '33333333333', timestamp '2017-04-04 16:00' - interval '3 hours');

insert into maratona values (4, 1, timestamp '2017-05-05 16:00' - interval '3 hours', 'Maratona de todos os santos', 'Rio de Janeiro', 'RJ', 'Rua do Rio', 'Rua final do Rio', time '18:00' - interval '3 hours', '33333333333', timestamp '2017-05-05 16:00' - interval '3 hours');

insert into maratona values (5, 1, timestamp '2017-06-06 16:00' - interval '3 hours', 'Maratona de Maceió', 'Maceió', 'AL', 'Rua de Maceió', 'Rua final de Maceió', time '18:00' - interval '3 hours', '33333333333', timestamp '2017-06-06 16:00' - interval '3 hours');

delete from usuario where idusuario=1;

select * from maratona;

data, cidade, estado, local inicio, local fim, hora estimada termino, fone contato, data fim inscr