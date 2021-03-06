<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150304120143 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ext_translations (id INT AUTO_INCREMENT NOT NULL, locale VARCHAR(8) NOT NULL, object_class VARCHAR(255) NOT NULL, field VARCHAR(32) NOT NULL, foreign_key VARCHAR(64) NOT NULL, content LONGTEXT DEFAULT NULL, INDEX translations_lookup_idx (locale, object_class, foreign_key), UNIQUE INDEX lookup_unique_idx (locale, object_class, field, foreign_key), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ext_log_entries (id INT AUTO_INCREMENT NOT NULL, action VARCHAR(8) NOT NULL, logged_at DATETIME NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', username VARCHAR(255) DEFAULT NULL, INDEX log_class_lookup_idx (object_class), INDEX log_date_lookup_idx (logged_at), INDEX log_user_lookup_idx (username), INDEX log_version_lookup_idx (object_id, object_class, version), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_nodes (id BIGINT AUTO_INCREMENT NOT NULL, parent_id BIGINT DEFAULT NULL, sequence_number INT NOT NULL, lft INT DEFAULT NULL, lvl INT DEFAULT NULL, rgt INT DEFAULT NULL, deleted TINYINT(1) NOT NULL, hidden_from_nav TINYINT(1) NOT NULL, ref_entity_name VARCHAR(255) NOT NULL, internal_name VARCHAR(255) DEFAULT NULL, INDEX IDX_3051AB93727ACA70 (parent_id), INDEX idx_internal_name (internal_name), INDEX idx_ref_entity_name (ref_entity_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_node_translations (id BIGINT AUTO_INCREMENT NOT NULL, node_id BIGINT DEFAULT NULL, public_node_version_id BIGINT DEFAULT NULL, lang VARCHAR(255) NOT NULL, online TINYINT(1) NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, weight SMALLINT DEFAULT NULL, created DATETIME DEFAULT NULL, updated DATETIME DEFAULT NULL, INDEX IDX_5E8968CD460D9FD7 (node_id), INDEX IDX_5E8968CDB9A563EE (public_node_version_id), INDEX idx_lang_url (lang, url), UNIQUE INDEX ix_kuma_node_translations_node_lang (node_id, lang), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_node_versions (id BIGINT AUTO_INCREMENT NOT NULL, node_translation_id BIGINT DEFAULT NULL, origin_id BIGINT DEFAULT NULL, type VARCHAR(255) NOT NULL, owner VARCHAR(255) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, ref_id BIGINT NOT NULL, ref_entity_name VARCHAR(255) NOT NULL, INDEX IDX_FF496637E0B87CE0 (node_translation_id), INDEX IDX_FF49663756A273CC (origin_id), INDEX idx_kuma_lookup (ref_id, ref_entity_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_node_queued_node_translation_actions (id BIGINT AUTO_INCREMENT NOT NULL, node_translation_id BIGINT DEFAULT NULL, user_id INT DEFAULT NULL, action VARCHAR(255) NOT NULL, date DATETIME NOT NULL, INDEX IDX_D270D8D1E0B87CE0 (node_translation_id), INDEX IDX_D270D8D1A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_seo (id BIGINT AUTO_INCREMENT NOT NULL, og_image_id BIGINT DEFAULT NULL, meta_title VARCHAR(255) DEFAULT NULL, meta_description LONGTEXT DEFAULT NULL, meta_author VARCHAR(255) DEFAULT NULL, meta_keywords VARCHAR(255) DEFAULT NULL, meta_robots VARCHAR(255) DEFAULT NULL, meta_revised VARCHAR(255) DEFAULT NULL, og_type VARCHAR(255) DEFAULT NULL, og_title VARCHAR(255) DEFAULT NULL, og_description LONGTEXT DEFAULT NULL, extra_metadata LONGTEXT DEFAULT NULL, ref_id BIGINT NOT NULL, ref_entity_name VARCHAR(255) NOT NULL, linked_in_recommend_link VARCHAR(255) DEFAULT NULL, linked_in_recommend_product_id VARCHAR(255) DEFAULT NULL, og_url VARCHAR(255) DEFAULT NULL, INDEX IDX_4695F4A76EFCB8B8 (og_image_id), INDEX idx_lookup (ref_id, ref_entity_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_folders (id BIGINT AUTO_INCREMENT NOT NULL, parent_id BIGINT DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, rel VARCHAR(255) DEFAULT NULL, internal_name VARCHAR(255) DEFAULT NULL, lft INT DEFAULT NULL, lvl INT DEFAULT NULL, rgt INT DEFAULT NULL, deleted TINYINT(1) NOT NULL, INDEX IDX_2D3C07E4727ACA70 (parent_id), INDEX idx_internal_name (internal_name), INDEX idx_name (name), INDEX idx_deleted (deleted), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_media (id BIGINT AUTO_INCREMENT NOT NULL, folder_id BIGINT DEFAULT NULL, uuid VARCHAR(255) NOT NULL, name VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, copyright VARCHAR(255) DEFAULT NULL, location VARCHAR(255) DEFAULT NULL, content_type VARCHAR(255) NOT NULL, metadata LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, filesize INT DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, original_filename VARCHAR(255) DEFAULT NULL, deleted TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_47400F63D17F50A6 (uuid), INDEX IDX_47400F63162CB942 (folder_id), INDEX idx_name (name), INDEX idx_deleted (deleted), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, admin_locale VARCHAR(5) DEFAULT NULL, UNIQUE INDEX UNIQ_39EF0B8692FC23A8 (username_canonical), UNIQUE INDEX UNIQ_39EF0B86A0D96FBF (email_canonical), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_users_groups (user_id INT NOT NULL, group_id INT NOT NULL, INDEX IDX_AFF816DDA76ED395 (user_id), INDEX IDX_AFF816DDFE54D947 (group_id), PRIMARY KEY(user_id, group_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_groups (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_groups_roles (group_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_B7EFE85EFE54D947 (group_id), INDEX IDX_B7EFE85ED60322AC (role_id), PRIMARY KEY(group_id, role_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_acl_changesets (id BIGINT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, ref_id BIGINT NOT NULL, ref_entity_name VARCHAR(255) NOT NULL, changeset LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', pid INT DEFAULT NULL, status INT NOT NULL, created DATETIME DEFAULT NULL, last_modified DATETIME DEFAULT NULL, INDEX IDX_953E7491A76ED395 (user_id), INDEX idx_ref (ref_id, ref_entity_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_dashboard_configurations (id BIGINT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, content LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_roles (id INT AUTO_INCREMENT NOT NULL, role VARCHAR(70) NOT NULL, UNIQUE INDEX UNIQ_9B5280A857698A6A (role), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_header_page_parts (id BIGINT AUTO_INCREMENT NOT NULL, niv INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_line_page_parts (id BIGINT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_link_page_parts (id BIGINT AUTO_INCREMENT NOT NULL, url VARCHAR(255) DEFAULT NULL, openinnewwindow TINYINT(1) DEFAULT NULL, text VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_page_part_refs (id BIGINT AUTO_INCREMENT NOT NULL, pageId BIGINT NOT NULL, pageEntityname VARCHAR(255) NOT NULL, context VARCHAR(255) NOT NULL, sequencenumber INT NOT NULL, pagePartId BIGINT NOT NULL, pagePartEntityname VARCHAR(255) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, INDEX idx_kuma_search (pageId, pageEntityname, context), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_page_template_configuration (id BIGINT AUTO_INCREMENT NOT NULL, page_id BIGINT NOT NULL, page_entity_name VARCHAR(255) NOT NULL, page_template VARCHAR(255) NOT NULL, INDEX idx_kuma_search (page_id, page_entity_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_raw_html_page_parts (id BIGINT AUTO_INCREMENT NOT NULL, content LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_text_page_parts (id BIGINT AUTO_INCREMENT NOT NULL, content LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_toc_page_parts (id BIGINT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_to_top_page_parts (id BIGINT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_audio_page_parts (id BIGINT AUTO_INCREMENT NOT NULL, media_id BIGINT DEFAULT NULL, INDEX IDX_A30C548EEA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_download_page_parts (id BIGINT AUTO_INCREMENT NOT NULL, media_id BIGINT DEFAULT NULL, INDEX IDX_65E8DB81EA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_image_page_parts (id BIGINT AUTO_INCREMENT NOT NULL, media_id BIGINT DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, open_in_new_window TINYINT(1) DEFAULT NULL, alt_text VARCHAR(255) DEFAULT NULL, INDEX IDX_CF8612B5EA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_slide_page_parts (id BIGINT AUTO_INCREMENT NOT NULL, media_id BIGINT DEFAULT NULL, INDEX IDX_EA7A3F17EA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_video_page_parts (id BIGINT AUTO_INCREMENT NOT NULL, media_id BIGINT DEFAULT NULL, INDEX IDX_23FF1D35EA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_form_submissions (id BIGINT AUTO_INCREMENT NOT NULL, node_id BIGINT DEFAULT NULL, ip_address VARCHAR(255) NOT NULL, lang VARCHAR(255) NOT NULL, created DATETIME NOT NULL, INDEX IDX_6493A44D460D9FD7 (node_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_form_submission_fields (id BIGINT AUTO_INCREMENT NOT NULL, form_submission_id BIGINT DEFAULT NULL, fieldName VARCHAR(255) NOT NULL, `label` VARCHAR(255) NOT NULL, discr VARCHAR(255) NOT NULL, sfsf_value VARCHAR(255) DEFAULT NULL, tfsf_value LONGTEXT DEFAULT NULL, bfsf_value TINYINT(1) DEFAULT NULL, cfsf_value LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', expanded TINYINT(1) DEFAULT NULL, multiple TINYINT(1) DEFAULT NULL, choices LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', required TINYINT(1) DEFAULT NULL, ffsf_value VARCHAR(255) DEFAULT NULL, efsf_value VARCHAR(255) DEFAULT NULL, INDEX IDX_A0B2BD32422B0E0C (form_submission_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_checkbox_page_parts (id BIGINT AUTO_INCREMENT NOT NULL, required TINYINT(1) DEFAULT NULL, error_message_required VARCHAR(255) DEFAULT NULL, `label` VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_choice_page_parts (id BIGINT AUTO_INCREMENT NOT NULL, expanded TINYINT(1) DEFAULT NULL, multiple TINYINT(1) DEFAULT NULL, choices LONGTEXT DEFAULT NULL, empty_value VARCHAR(255) DEFAULT NULL, required TINYINT(1) DEFAULT NULL, error_message_required VARCHAR(255) DEFAULT NULL, `label` VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_email_page_parts (id BIGINT AUTO_INCREMENT NOT NULL, required TINYINT(1) DEFAULT NULL, error_message_required VARCHAR(255) DEFAULT NULL, error_message_invalid VARCHAR(255) DEFAULT NULL, `label` VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_file_upload_page_parts (id BIGINT AUTO_INCREMENT NOT NULL, required TINYINT(1) DEFAULT NULL, error_message_required VARCHAR(255) DEFAULT NULL, `label` VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_multi_line_text_page_parts (id BIGINT AUTO_INCREMENT NOT NULL, required TINYINT(1) DEFAULT NULL, error_message_required VARCHAR(255) DEFAULT NULL, regex VARCHAR(255) DEFAULT NULL, error_message_regex VARCHAR(255) DEFAULT NULL, `label` VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_single_line_text_page_parts (id BIGINT AUTO_INCREMENT NOT NULL, required TINYINT(1) DEFAULT NULL, error_message_required VARCHAR(255) DEFAULT NULL, regex VARCHAR(255) DEFAULT NULL, error_message_regex VARCHAR(255) DEFAULT NULL, `label` VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_submit_button_page_parts (id BIGINT AUTO_INCREMENT NOT NULL, `label` VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_nodes_search (id BIGINT AUTO_INCREMENT NOT NULL, node_id BIGINT DEFAULT NULL, boost DOUBLE PRECISION DEFAULT NULL, UNIQUE INDEX UNIQ_1560AF72460D9FD7 (node_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_sitemap_pages (id BIGINT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, page_title VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_translation (id INT AUTO_INCREMENT NOT NULL, translation_id INT DEFAULT NULL, keyword VARCHAR(255) DEFAULT NULL, locale VARCHAR(5) DEFAULT NULL, file VARCHAR(50) DEFAULT NULL, text LONGTEXT DEFAULT NULL, domain VARCHAR(30) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, flag VARCHAR(20) DEFAULT NULL, INDEX idx_locale_domain (locale, domain), UNIQUE INDEX keyword_per_locale (keyword, locale, domain), UNIQUE INDEX translation_id_per_locale (translation_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuma_redirects (id BIGINT AUTO_INCREMENT NOT NULL, origin VARCHAR(255) NOT NULL, target VARCHAR(255) NOT NULL, permanent TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE acl_classes (id INT UNSIGNED AUTO_INCREMENT NOT NULL, class_type VARCHAR(200) NOT NULL, UNIQUE INDEX UNIQ_69DD750638A36066 (class_type), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE acl_security_identities (id INT UNSIGNED AUTO_INCREMENT NOT NULL, identifier VARCHAR(200) NOT NULL, username TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8835EE78772E836AF85E0677 (identifier, username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE acl_object_identities (id INT UNSIGNED AUTO_INCREMENT NOT NULL, parent_object_identity_id INT UNSIGNED DEFAULT NULL, class_id INT UNSIGNED NOT NULL, object_identifier VARCHAR(100) NOT NULL, entries_inheriting TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_9407E5494B12AD6EA000B10 (object_identifier, class_id), INDEX IDX_9407E54977FA751A (parent_object_identity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE acl_object_identity_ancestors (object_identity_id INT UNSIGNED NOT NULL, ancestor_id INT UNSIGNED NOT NULL, INDEX IDX_825DE2993D9AB4A6 (object_identity_id), INDEX IDX_825DE299C671CEA1 (ancestor_id), PRIMARY KEY(object_identity_id, ancestor_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE acl_entries (id INT UNSIGNED AUTO_INCREMENT NOT NULL, class_id INT UNSIGNED NOT NULL, object_identity_id INT UNSIGNED DEFAULT NULL, security_identity_id INT UNSIGNED NOT NULL, field_name VARCHAR(50) DEFAULT NULL, ace_order SMALLINT UNSIGNED NOT NULL, mask INT NOT NULL, granting TINYINT(1) NOT NULL, granting_strategy VARCHAR(30) NOT NULL, audit_success TINYINT(1) NOT NULL, audit_failure TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_46C8B806EA000B103D9AB4A64DEF17BCE4289BF4 (class_id, object_identity_id, field_name, ace_order), INDEX IDX_46C8B806EA000B103D9AB4A6DF9183C9 (class_id, object_identity_id, security_identity_id), INDEX IDX_46C8B806EA000B10 (class_id), INDEX IDX_46C8B8063D9AB4A6 (object_identity_id), INDEX IDX_46C8B806DF9183C9 (security_identity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE kuma_nodes ADD CONSTRAINT FK_3051AB93727ACA70 FOREIGN KEY (parent_id) REFERENCES kuma_nodes (id)');
        $this->addSql('ALTER TABLE kuma_node_translations ADD CONSTRAINT FK_5E8968CD460D9FD7 FOREIGN KEY (node_id) REFERENCES kuma_nodes (id)');
        $this->addSql('ALTER TABLE kuma_node_translations ADD CONSTRAINT FK_5E8968CDB9A563EE FOREIGN KEY (public_node_version_id) REFERENCES kuma_node_versions (id)');
        $this->addSql('ALTER TABLE kuma_node_versions ADD CONSTRAINT FK_FF496637E0B87CE0 FOREIGN KEY (node_translation_id) REFERENCES kuma_node_translations (id)');
        $this->addSql('ALTER TABLE kuma_node_versions ADD CONSTRAINT FK_FF49663756A273CC FOREIGN KEY (origin_id) REFERENCES kuma_node_versions (id)');
        $this->addSql('ALTER TABLE kuma_node_queued_node_translation_actions ADD CONSTRAINT FK_D270D8D1E0B87CE0 FOREIGN KEY (node_translation_id) REFERENCES kuma_node_translations (id)');
        $this->addSql('ALTER TABLE kuma_node_queued_node_translation_actions ADD CONSTRAINT FK_D270D8D1A76ED395 FOREIGN KEY (user_id) REFERENCES kuma_users (id)');
        $this->addSql('ALTER TABLE kuma_seo ADD CONSTRAINT FK_4695F4A76EFCB8B8 FOREIGN KEY (og_image_id) REFERENCES kuma_media (id)');
        $this->addSql('ALTER TABLE kuma_folders ADD CONSTRAINT FK_2D3C07E4727ACA70 FOREIGN KEY (parent_id) REFERENCES kuma_folders (id)');
        $this->addSql('ALTER TABLE kuma_media ADD CONSTRAINT FK_47400F63162CB942 FOREIGN KEY (folder_id) REFERENCES kuma_folders (id)');
        $this->addSql('ALTER TABLE kuma_users_groups ADD CONSTRAINT FK_AFF816DDA76ED395 FOREIGN KEY (user_id) REFERENCES kuma_users (id)');
        $this->addSql('ALTER TABLE kuma_users_groups ADD CONSTRAINT FK_AFF816DDFE54D947 FOREIGN KEY (group_id) REFERENCES kuma_groups (id)');
        $this->addSql('ALTER TABLE kuma_groups_roles ADD CONSTRAINT FK_B7EFE85EFE54D947 FOREIGN KEY (group_id) REFERENCES kuma_groups (id)');
        $this->addSql('ALTER TABLE kuma_groups_roles ADD CONSTRAINT FK_B7EFE85ED60322AC FOREIGN KEY (role_id) REFERENCES kuma_roles (id)');
        $this->addSql('ALTER TABLE kuma_acl_changesets ADD CONSTRAINT FK_953E7491A76ED395 FOREIGN KEY (user_id) REFERENCES kuma_users (id)');
        $this->addSql('ALTER TABLE kuma_audio_page_parts ADD CONSTRAINT FK_A30C548EEA9FDD75 FOREIGN KEY (media_id) REFERENCES kuma_media (id)');
        $this->addSql('ALTER TABLE kuma_download_page_parts ADD CONSTRAINT FK_65E8DB81EA9FDD75 FOREIGN KEY (media_id) REFERENCES kuma_media (id)');
        $this->addSql('ALTER TABLE kuma_image_page_parts ADD CONSTRAINT FK_CF8612B5EA9FDD75 FOREIGN KEY (media_id) REFERENCES kuma_media (id)');
        $this->addSql('ALTER TABLE kuma_slide_page_parts ADD CONSTRAINT FK_EA7A3F17EA9FDD75 FOREIGN KEY (media_id) REFERENCES kuma_media (id)');
        $this->addSql('ALTER TABLE kuma_video_page_parts ADD CONSTRAINT FK_23FF1D35EA9FDD75 FOREIGN KEY (media_id) REFERENCES kuma_media (id)');
        $this->addSql('ALTER TABLE kuma_form_submissions ADD CONSTRAINT FK_6493A44D460D9FD7 FOREIGN KEY (node_id) REFERENCES kuma_nodes (id)');
        $this->addSql('ALTER TABLE kuma_form_submission_fields ADD CONSTRAINT FK_A0B2BD32422B0E0C FOREIGN KEY (form_submission_id) REFERENCES kuma_form_submissions (id)');
        $this->addSql('ALTER TABLE kuma_nodes_search ADD CONSTRAINT FK_1560AF72460D9FD7 FOREIGN KEY (node_id) REFERENCES kuma_nodes (id)');
        $this->addSql('ALTER TABLE acl_object_identities ADD CONSTRAINT FK_9407E54977FA751A FOREIGN KEY (parent_object_identity_id) REFERENCES acl_object_identities (id)');
        $this->addSql('ALTER TABLE acl_object_identity_ancestors ADD CONSTRAINT FK_825DE2993D9AB4A6 FOREIGN KEY (object_identity_id) REFERENCES acl_object_identities (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE acl_object_identity_ancestors ADD CONSTRAINT FK_825DE299C671CEA1 FOREIGN KEY (ancestor_id) REFERENCES acl_object_identities (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE acl_entries ADD CONSTRAINT FK_46C8B806EA000B10 FOREIGN KEY (class_id) REFERENCES acl_classes (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE acl_entries ADD CONSTRAINT FK_46C8B8063D9AB4A6 FOREIGN KEY (object_identity_id) REFERENCES acl_object_identities (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE acl_entries ADD CONSTRAINT FK_46C8B806DF9183C9 FOREIGN KEY (security_identity_id) REFERENCES acl_security_identities (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE kuma_nodes DROP FOREIGN KEY FK_3051AB93727ACA70');
        $this->addSql('ALTER TABLE kuma_node_translations DROP FOREIGN KEY FK_5E8968CD460D9FD7');
        $this->addSql('ALTER TABLE kuma_form_submissions DROP FOREIGN KEY FK_6493A44D460D9FD7');
        $this->addSql('ALTER TABLE kuma_nodes_search DROP FOREIGN KEY FK_1560AF72460D9FD7');
        $this->addSql('ALTER TABLE kuma_node_versions DROP FOREIGN KEY FK_FF496637E0B87CE0');
        $this->addSql('ALTER TABLE kuma_node_queued_node_translation_actions DROP FOREIGN KEY FK_D270D8D1E0B87CE0');
        $this->addSql('ALTER TABLE kuma_node_translations DROP FOREIGN KEY FK_5E8968CDB9A563EE');
        $this->addSql('ALTER TABLE kuma_node_versions DROP FOREIGN KEY FK_FF49663756A273CC');
        $this->addSql('ALTER TABLE kuma_folders DROP FOREIGN KEY FK_2D3C07E4727ACA70');
        $this->addSql('ALTER TABLE kuma_media DROP FOREIGN KEY FK_47400F63162CB942');
        $this->addSql('ALTER TABLE kuma_seo DROP FOREIGN KEY FK_4695F4A76EFCB8B8');
        $this->addSql('ALTER TABLE kuma_audio_page_parts DROP FOREIGN KEY FK_A30C548EEA9FDD75');
        $this->addSql('ALTER TABLE kuma_download_page_parts DROP FOREIGN KEY FK_65E8DB81EA9FDD75');
        $this->addSql('ALTER TABLE kuma_image_page_parts DROP FOREIGN KEY FK_CF8612B5EA9FDD75');
        $this->addSql('ALTER TABLE kuma_slide_page_parts DROP FOREIGN KEY FK_EA7A3F17EA9FDD75');
        $this->addSql('ALTER TABLE kuma_video_page_parts DROP FOREIGN KEY FK_23FF1D35EA9FDD75');
        $this->addSql('ALTER TABLE kuma_node_queued_node_translation_actions DROP FOREIGN KEY FK_D270D8D1A76ED395');
        $this->addSql('ALTER TABLE kuma_users_groups DROP FOREIGN KEY FK_AFF816DDA76ED395');
        $this->addSql('ALTER TABLE kuma_acl_changesets DROP FOREIGN KEY FK_953E7491A76ED395');
        $this->addSql('ALTER TABLE kuma_users_groups DROP FOREIGN KEY FK_AFF816DDFE54D947');
        $this->addSql('ALTER TABLE kuma_groups_roles DROP FOREIGN KEY FK_B7EFE85EFE54D947');
        $this->addSql('ALTER TABLE kuma_groups_roles DROP FOREIGN KEY FK_B7EFE85ED60322AC');
        $this->addSql('ALTER TABLE kuma_form_submission_fields DROP FOREIGN KEY FK_A0B2BD32422B0E0C');
        $this->addSql('ALTER TABLE acl_entries DROP FOREIGN KEY FK_46C8B806EA000B10');
        $this->addSql('ALTER TABLE acl_entries DROP FOREIGN KEY FK_46C8B806DF9183C9');
        $this->addSql('ALTER TABLE acl_object_identities DROP FOREIGN KEY FK_9407E54977FA751A');
        $this->addSql('ALTER TABLE acl_object_identity_ancestors DROP FOREIGN KEY FK_825DE2993D9AB4A6');
        $this->addSql('ALTER TABLE acl_object_identity_ancestors DROP FOREIGN KEY FK_825DE299C671CEA1');
        $this->addSql('ALTER TABLE acl_entries DROP FOREIGN KEY FK_46C8B8063D9AB4A6');
        $this->addSql('DROP TABLE ext_translations');
        $this->addSql('DROP TABLE ext_log_entries');
        $this->addSql('DROP TABLE kuma_nodes');
        $this->addSql('DROP TABLE kuma_node_translations');
        $this->addSql('DROP TABLE kuma_node_versions');
        $this->addSql('DROP TABLE kuma_node_queued_node_translation_actions');
        $this->addSql('DROP TABLE kuma_seo');
        $this->addSql('DROP TABLE kuma_folders');
        $this->addSql('DROP TABLE kuma_media');
        $this->addSql('DROP TABLE kuma_users');
        $this->addSql('DROP TABLE kuma_users_groups');
        $this->addSql('DROP TABLE kuma_groups');
        $this->addSql('DROP TABLE kuma_groups_roles');
        $this->addSql('DROP TABLE kuma_acl_changesets');
        $this->addSql('DROP TABLE kuma_dashboard_configurations');
        $this->addSql('DROP TABLE kuma_roles');
        $this->addSql('DROP TABLE kuma_header_page_parts');
        $this->addSql('DROP TABLE kuma_line_page_parts');
        $this->addSql('DROP TABLE kuma_link_page_parts');
        $this->addSql('DROP TABLE kuma_page_part_refs');
        $this->addSql('DROP TABLE kuma_page_template_configuration');
        $this->addSql('DROP TABLE kuma_raw_html_page_parts');
        $this->addSql('DROP TABLE kuma_text_page_parts');
        $this->addSql('DROP TABLE kuma_toc_page_parts');
        $this->addSql('DROP TABLE kuma_to_top_page_parts');
        $this->addSql('DROP TABLE kuma_audio_page_parts');
        $this->addSql('DROP TABLE kuma_download_page_parts');
        $this->addSql('DROP TABLE kuma_image_page_parts');
        $this->addSql('DROP TABLE kuma_slide_page_parts');
        $this->addSql('DROP TABLE kuma_video_page_parts');
        $this->addSql('DROP TABLE kuma_form_submissions');
        $this->addSql('DROP TABLE kuma_form_submission_fields');
        $this->addSql('DROP TABLE kuma_checkbox_page_parts');
        $this->addSql('DROP TABLE kuma_choice_page_parts');
        $this->addSql('DROP TABLE kuma_email_page_parts');
        $this->addSql('DROP TABLE kuma_file_upload_page_parts');
        $this->addSql('DROP TABLE kuma_multi_line_text_page_parts');
        $this->addSql('DROP TABLE kuma_single_line_text_page_parts');
        $this->addSql('DROP TABLE kuma_submit_button_page_parts');
        $this->addSql('DROP TABLE kuma_nodes_search');
        $this->addSql('DROP TABLE kuma_sitemap_pages');
        $this->addSql('DROP TABLE kuma_translation');
        $this->addSql('DROP TABLE kuma_redirects');
        $this->addSql('DROP TABLE acl_classes');
        $this->addSql('DROP TABLE acl_security_identities');
        $this->addSql('DROP TABLE acl_object_identities');
        $this->addSql('DROP TABLE acl_object_identity_ancestors');
        $this->addSql('DROP TABLE acl_entries');
    }
}
