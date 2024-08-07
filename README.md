# Sample Project for myself - CakePhp 5.x Translate

A skeleton for creating applications with [CakePHP](https://cakephp.org) 5.x.

The framework source code can be found here: [cakephp/cakephp](https://github.com/cakephp/cakephp).

I tried this project: [CakePhp 5.x Translate](https://book.cakephp.org/5/en/orm/behaviors/translate.html)

### Install:
```sh
# gh repo clone zsfoto/Sample_CakePhp-5_Translate
# composer install
```

Don't forget to edit the app_local.php...


```sql
CREATE TABLE articles (
  id int(11) NOT NULL,
  title varchar(255) DEFAULT NULL,
  body text DEFAULT NULL,
  created datetime NOT NULL,
  modified datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE articles
  ADD PRIMARY KEY (id) USING BTREE;
```

```sql
CREATE TABLE i18n (
    id int NOT NULL auto_increment,
    locale varchar(6) NOT NULL,
    model varchar(255) NOT NULL,
    foreign_key int(10) NOT NULL,
    field varchar(255) NOT NULL,
    content text,
    PRIMARY KEY (id),
    UNIQUE INDEX I18N_LOCALE_FIELD(locale, model, foreign_key, field),
    INDEX I18N_FIELD(model, foreign_key, field)
);
```

```sql
CREATE TABLE langs (
  id int(11) NOT NULL,
  pos int(11) NOT NULL,
  name varchar(100) NOT NULL,
  lang varchar(6) NOT NULL,
  visible tinyint(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Languages table';
```

#####Insert datas to langs table:
```sql
INSERT INTO langs (id, pos, name, lang, visible) VALUES
(1, 1, 'Magyar', 'hu', 1),
(2, 500, 'Angol GB', 'en_GB', 1),
(3, 500, 'Angol US', 'en_US', 0),
(4, 500, 'Deutsch', 'de', 1),
(5, 600, 'Croatian', 'hr', 1);
```

