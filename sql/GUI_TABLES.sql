CREATE TABLE GUI_ITEM_TAGS (
    itemId int,
	tagId int
);

CREATE INDEX GUI_ITEM_TAGS_IDX ON GUI_ITEM_TAGS (tagId);

CREATE TABLE GUI_TAG_NAMES (
	tagId int NOT NULL AUTO_INCREMENT,
    tagName varchar(255),
    tagColor varchar(6),
    PRIMARY KEY ( tagId )
);

CREATE TABLE GUI_ITEM_ICONS (
  iconId int,
  iconFile varchar(255),
  PRIMARY KEY ( iconId )
);