CREATE DATABASE IF NOT EXISTS `INASE_DATABASE`;

CREATE TABLE  `INASE_DATABASE`.`samples` (
    uuid CHAR(36) NOT NULL PRIMARY KEY DEFAULT (UUID()),
    seal_number VARCHAR(50) NOT NULL,
    company VARCHAR(100) NOT NULL,
    species VARCHAR(100) NOT NULL,
    quantity INT NOT NULL
);

CREATE TABLE `INASE_DATABASE`.`laboratory_analysis` (
    sample_uuid CHAR(36) NOT NULL PRIMARY KEY ,
    germination_power DECIMAL(5,2) NOT NULL,
    purity DECIMAL(5,2) NOT NULL,
    inert_materials VARCHAR(255),
    CONSTRAINT fk_lab_analysis_sample
    FOREIGN KEY (sample_uuid)
    REFERENCES samples(uuid)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);





