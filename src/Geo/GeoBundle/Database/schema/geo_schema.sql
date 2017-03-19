CREATE TABLE geo_aree_geografica (id BIGINT AUTO_INCREMENT NOT NULL, codice VARCHAR(1) NOT NULL, area VARCHAR(10) NOT NULL, codice_nuts VARCHAR(3) NOT NULL, UNIQUE INDEX UNIQ_1E73D00DA48A0183 (codice), UNIQUE INDEX UNIQ_1E73D00D1FCE5364 (codice_nuts), PRIMARY KEY(id)) ENGINE = InnoDB;
CREATE TABLE geo_aree_geopolitiche (id BIGINT AUTO_INCREMENT NOT NULL, continente_id BIGINT NOT NULL, codice VARCHAR(2) NOT NULL, area VARCHAR(32) NOT NULL, UNIQUE INDEX UNIQ_A98F6B03A48A0183 (codice), INDEX IDX_A98F6B035CF04EB5 (continente_id), PRIMARY KEY(id)) ENGINE = InnoDB;
CREATE TABLE geo_censimenti (id BIGINT AUTO_INCREMENT NOT NULL, stato_id BIGINT NOT NULL, codice VARCHAR(5) NOT NULL, data_censimento DATE NOT NULL, popolazione_legale TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_D1E78524A48A0183 (codice), INDEX IDX_D1E785246A65DCA5 (stato_id), PRIMARY KEY(id)) ENGINE = InnoDB;
CREATE TABLE geo_comuni (id BIGINT AUTO_INCREMENT NOT NULL, zona_altimetrica_id BIGINT NOT NULL, sistema_locale_lavoro_id BIGINT NOT NULL, provincia_id BIGINT NOT NULL, denominazione_it VARCHAR(128) NOT NULL, denominazione_de VARCHAR(128) NOT NULL, capoluogo TINYINT(1) NOT NULL, altitudine NUMERIC(10, 0) NOT NULL, litoraneo TINYINT(1) NOT NULL, montano VARCHAR(1) NOT NULL, superficie NUMERIC(10, 0) NOT NULL, denominazione VARCHAR(256) NOT NULL, codice_completo VARCHAR(15) NOT NULL, codice VARCHAR(3) NOT NULL, data_istituzione DATE NOT NULL, data_destituzione DATE DEFAULT NULL, INDEX IDX_DB771F05B2235EF0 (zona_altimetrica_id), INDEX IDX_DB771F05B28762CA (sistema_locale_lavoro_id), INDEX IDX_DB771F054E7121AF (provincia_id), INDEX codice_idx (codice), INDEX codice_completo_idx (codice_completo), PRIMARY KEY(id)) ENGINE = InnoDB;
CREATE TABLE geo_continenti (id BIGINT AUTO_INCREMENT NOT NULL, codice VARCHAR(1) NOT NULL, continente VARCHAR(16) NOT NULL, UNIQUE INDEX UNIQ_C6CE4BE4A48A0183 (codice), PRIMARY KEY(id)) ENGINE = InnoDB;
CREATE TABLE geo_popolazione (id BIGINT AUTO_INCREMENT NOT NULL, comune_id BIGINT NOT NULL, censimento_id BIGINT NOT NULL, popolazione BIGINT NOT NULL, INDEX IDX_B987FBEA885878B0 (comune_id), INDEX IDX_B987FBEAB5295A2A (censimento_id), PRIMARY KEY(id)) ENGINE = InnoDB;
CREATE TABLE geo_province (id BIGINT AUTO_INCREMENT NOT NULL, regione_id BIGINT NOT NULL, codice_nuts VARCHAR(5) NOT NULL, sigla_automobilistica VARCHAR(2) NOT NULL, denominazione VARCHAR(256) NOT NULL, codice_completo VARCHAR(15) NOT NULL, codice VARCHAR(3) NOT NULL, data_istituzione DATE NOT NULL, data_destituzione DATE DEFAULT NULL, INDEX IDX_A463A3AA899A361C (regione_id), INDEX codice_idx (codice), INDEX codice_completo_idx (codice_completo), PRIMARY KEY(id)) ENGINE = InnoDB;
CREATE TABLE geo_regioni (id BIGINT AUTO_INCREMENT NOT NULL, area_geografica_id BIGINT NOT NULL, stato_id BIGINT NOT NULL, codice_nuts VARCHAR(4) NOT NULL, denominazione VARCHAR(256) NOT NULL, codice_completo VARCHAR(15) NOT NULL, codice VARCHAR(3) NOT NULL, data_istituzione DATE NOT NULL, data_destituzione DATE DEFAULT NULL, INDEX IDX_E8130D8BE4AF09B2 (area_geografica_id), INDEX IDX_E8130D8B6A65DCA5 (stato_id), INDEX codice_idx (codice), INDEX codice_completo_idx (codice_completo), PRIMARY KEY(id)) ENGINE = InnoDB;
CREATE TABLE geo_sistemi_locale_lavoro (id BIGINT AUTO_INCREMENT NOT NULL, codice VARCHAR(3) NOT NULL, denominazione VARCHAR(64) NOT NULL, UNIQUE INDEX UNIQ_65FB7050A48A0183 (codice), PRIMARY KEY(id)) ENGINE = InnoDB;
CREATE TABLE geo_stati (id BIGINT AUTO_INCREMENT NOT NULL, area_geopolitica_id BIGINT NOT NULL, denominazione VARCHAR(256) NOT NULL, codice_completo VARCHAR(15) NOT NULL, codice VARCHAR(3) NOT NULL, data_istituzione DATE NOT NULL, data_destituzione DATE DEFAULT NULL, INDEX IDX_AA21B9FF984AFC7B (area_geopolitica_id), INDEX codice_idx (codice), INDEX codice_completo_idx (codice_completo), PRIMARY KEY(id)) ENGINE = InnoDB;
CREATE TABLE geo_zone_altimetriche (id BIGINT AUTO_INCREMENT NOT NULL, codice VARCHAR(1) NOT NULL, zona VARCHAR(20) NOT NULL, UNIQUE INDEX UNIQ_96258F46A48A0183 (codice), PRIMARY KEY(id)) ENGINE = InnoDB;
ALTER TABLE geo_aree_geopolitiche ADD FOREIGN KEY (continente_id) REFERENCES geo_continenti(id);
ALTER TABLE geo_censimenti ADD FOREIGN KEY (stato_id) REFERENCES geo_stati(id);
ALTER TABLE geo_comuni ADD FOREIGN KEY (zona_altimetrica_id) REFERENCES geo_zone_altimetriche(id);
ALTER TABLE geo_comuni ADD FOREIGN KEY (sistema_locale_lavoro_id) REFERENCES geo_sistemi_locale_lavoro(id);
ALTER TABLE geo_comuni ADD FOREIGN KEY (provincia_id) REFERENCES geo_province(id);
ALTER TABLE geo_popolazione ADD FOREIGN KEY (comune_id) REFERENCES geo_comuni(id);
ALTER TABLE geo_popolazione ADD FOREIGN KEY (censimento_id) REFERENCES geo_censimenti(id);
ALTER TABLE geo_province ADD FOREIGN KEY (regione_id) REFERENCES geo_regioni(id);
ALTER TABLE geo_regioni ADD FOREIGN KEY (area_geografica_id) REFERENCES geo_aree_geografica(id);
ALTER TABLE geo_regioni ADD FOREIGN KEY (stato_id) REFERENCES geo_stati(id);
ALTER TABLE geo_stati ADD FOREIGN KEY (area_geopolitica_id) REFERENCES geo_aree_geopolitiche(id)