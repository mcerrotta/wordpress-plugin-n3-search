CREATE TABLE [dbo].[cursos] (
	id int NOT NULL IDENTITY(1,1),
	anio int NOT NULL,
	id_regimen varchar(3) NOT NULL,
    regimen nvarchar(127) NOT NULL,
    id_universidad int NOT NULL,
    universidad nvarchar(255) NOT NULL,
    id_unidad_academica int NOT NULL,
    unidad_academica nvarchar(255) NOT NULL,
    telefono nvarchar(255),
    email nvarchar(255),
    web nvarchar(255),
    id_titulo int NOT NULL,
    titulo nvarchar(255) NOT NULL,
    nivel_de_estudio nvarchar(255) NOT NULL,
    id_tipo_de_oferta varchar(10) NOT NULL,
    tipo_de_oferta varchar(255) NOT NULL,
    tipo_norma nvarchar(127) NOT NULL,
    fecha_norma date NOT NULL,
    numero_norma int,
    tipo_ingreso nvarchar(255) NOT NULL,
    duracion nvarchar(255) NOT NULL,
    vigencia nvarchar(255) NOT NULL,
    modalidad nvarchar(255) NOT NULL,
    domicilio nvarchar(512),
    codigo_postal nvarchar(40),
    localidad nvarchar(255),
    id_provincia varchar(3) NOT NULL,
    provincia varchar(255),
    id_pais varchar(3) NOT NULL,
    pais nvarchar(255) NOT NULL,
    id_rama varchar(3) NOT NULL,
    rama nvarchar(255),
    id_disciplina varchar(5) NOT NULL,
    disciplina nvarchar(255),
    id_area varchar(5) NOT NULL,
    area nvarchar(255),
	CONSTRAINT cursos_PK PRIMARY KEY (id)
);
CREATE INDEX cursos_id_regimen_IDX ON [dbo].[cursos] (id_regimen);
CREATE INDEX cursos_id_universidad_IDX ON [dbo].[cursos] (id_universidad);
CREATE INDEX cursos_id_unidad_academica_IDX ON [dbo].[cursos] (id_unidad_academica);
CREATE INDEX cursos_id_titulo_IDX ON [dbo].[cursos] (id_titulo);
CREATE INDEX cursos_id_tipo_de_oferta_IDX ON [dbo].[cursos] (id_tipo_de_oferta);
CREATE INDEX cursos_id_provincia_IDX ON [dbo].[cursos] (id_provincia);
CREATE INDEX cursos_id_pais_IDX ON [dbo].[cursos] (id_pais);
CREATE INDEX cursos_id_rama_IDX ON [dbo].[cursos] (id_rama);
