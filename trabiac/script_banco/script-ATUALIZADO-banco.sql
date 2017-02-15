CREATE TABLE usuario(
idusuario SERIAL PRIMARY KEY,
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
idmaratona SERIAL PRIMARY KEY,
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
percurso VARCHAR(4),
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
idinscr SERIAL PRIMARY KEY,
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
numpassaporte SERIAL PRIMARY KEY,
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







insert into usuario (nome_usuario, senha_usuario, pnome, mnome, unome, rg, cpf, data_nasc, email, fone_contato1, fone_contato2, fone_emergencia1, nome_contato1, parentesco_contato1, fone_emergencia2, nome_contato2, parentesco_contato2) values ('VilsonGatinho', 'vilson1234', 'Vilson', 'de', 'Souza', 987654321, 99987654321, '1980-01-01', 'vilsonzinho@goo.cof', '33333333333', '44444444444', '55555555555', 'Vilma', 'esposa', '66666666666', 'carlos', 'irm�o');  

insert into usuario (nome_usuario, senha_usuario, pnome, mnome, unome, rg, cpf, data_nasc, email, fone_contato1, fone_contato2, fone_emergencia1, nome_contato1, parentesco_contato1, fone_emergencia2, nome_contato2, parentesco_contato2) values ('Cleberjunior', 'cleber1234', 'Cleber', 'de', 'Lima', 912232222, 11999876321, '1980-02-02', 'cleberson@goo.cof', '22233333333', '22244444444', '22255555555', 'Silvia', 'irm�', '22266666666', 'Jairo', 'vaca');  



insert into maratona (idproprietario, datahora, nome_evento, cidade, estado, local_saida, local_chegada, hora_estm_termino, fone_contato, data_fim_inscr, percurso) values (1, timestamp '2016-12-13 16:00' - interval '3 hours', 'Maratona beneficente S�o Jo�o', 'Curitiba', 'pr', 'Rua XV de Novembro', 'Boca Maldita', time '18:00' - interval '3 hours', '33333333333', timestamp '2016-12-10 16:00' - interval '3 hours', '10km');

insert into maratona (idproprietario, datahora, nome_evento, cidade, estado, local_saida, local_chegada, hora_estm_termino, fone_contato, data_fim_inscr, percurso) values (1, timestamp '2017-02-10 16:00' - interval '3 hours', 'Maratona da Capela de Cuiab�', 'Cuiab�', 'MT', 'Rua do mato grosso', 'Rua final do mato grosso', time '18:00' - interval '3 hours', '33333333333', timestamp '2017-02-09 16:00' - interval '3 hours', '05km');

insert into maratona (idproprietario, datahora, nome_evento, cidade, estado, local_saida, local_chegada, hora_estm_termino, fone_contato, data_fim_inscr, percurso) values (1, timestamp '2017-04-04 16:00' - interval '3 hours', 'Maratona do estado de S�o Paulo', 'S�o Paulo', 'SP', 'Rua de S�o Paulo', 'Rua final de S�o Paulo', time '18:00' - interval '3 hours', '33333333333', timestamp '2017-04-04 16:00' - interval '3 hours', '21km');

insert into maratona (idproprietario, datahora, nome_evento, cidade, estado, local_saida, local_chegada, hora_estm_termino, fone_contato, data_fim_inscr, percurso) values (1, timestamp '2017-05-05 16:00' - interval '3 hours', 'Maratona de todos os santos', 'Rio de Janeiro', 'RJ', 'Rua do Rio', 'Rua final do Rio', time '18:00' - interval '3 hours', '33333333333', timestamp '2017-05-05 16:00' - interval '3 hours', '42km');

insert into maratona (idproprietario, datahora, nome_evento, cidade, estado, local_saida, local_chegada, hora_estm_termino, fone_contato, data_fim_inscr, percurso) values (1, timestamp '2017-06-06 16:00' - interval '3 hours', 'Maratona de Macei�', 'Macei�', 'AL', 'Rua de Macei�', 'Rua final de Macei�', time '18:00' - interval '3 hours', '33333333333', timestamp '2017-06-06 16:00' - interval '3 hours', '42km');






/*42, 21, 10, 05 km*/
