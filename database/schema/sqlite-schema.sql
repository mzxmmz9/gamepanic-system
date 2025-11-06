CREATE TABLE IF NOT EXISTS "migrations"(
  "id" integer primary key autoincrement not null,
  "migration" varchar not null,
  "batch" integer not null
);
CREATE TABLE IF NOT EXISTS "users"(
  "id" integer primary key autoincrement not null,
  "name" varchar not null,
  "email" varchar not null,
  "email_verified_at" datetime,
  "password" varchar not null,
  "remember_token" varchar,
  "created_at" datetime,
  "updated_at" datetime
);
CREATE UNIQUE INDEX "users_email_unique" on "users"("email");
CREATE TABLE IF NOT EXISTS "password_reset_tokens"(
  "email" varchar not null,
  "token" varchar not null,
  "created_at" datetime,
  primary key("email")
);
CREATE TABLE IF NOT EXISTS "sessions"(
  "id" varchar not null,
  "user_id" integer,
  "ip_address" varchar,
  "user_agent" text,
  "payload" text not null,
  "last_activity" integer not null,
  primary key("id")
);
CREATE INDEX "sessions_user_id_index" on "sessions"("user_id");
CREATE INDEX "sessions_last_activity_index" on "sessions"("last_activity");
CREATE TABLE IF NOT EXISTS "cache"(
  "key" varchar not null,
  "value" text not null,
  "expiration" integer not null,
  primary key("key")
);
CREATE TABLE IF NOT EXISTS "cache_locks"(
  "key" varchar not null,
  "owner" varchar not null,
  "expiration" integer not null,
  primary key("key")
);
CREATE TABLE IF NOT EXISTS "jobs"(
  "id" integer primary key autoincrement not null,
  "queue" varchar not null,
  "payload" text not null,
  "attempts" integer not null,
  "reserved_at" integer,
  "available_at" integer not null,
  "created_at" integer not null
);
CREATE INDEX "jobs_queue_index" on "jobs"("queue");
CREATE TABLE IF NOT EXISTS "job_batches"(
  "id" varchar not null,
  "name" varchar not null,
  "total_jobs" integer not null,
  "pending_jobs" integer not null,
  "failed_jobs" integer not null,
  "failed_job_ids" text not null,
  "options" text,
  "cancelled_at" integer,
  "created_at" integer not null,
  "finished_at" integer,
  primary key("id")
);
CREATE TABLE IF NOT EXISTS "failed_jobs"(
  "id" integer primary key autoincrement not null,
  "uuid" varchar not null,
  "connection" text not null,
  "queue" text not null,
  "payload" text not null,
  "exception" text not null,
  "failed_at" datetime not null default CURRENT_TIMESTAMP
);
CREATE UNIQUE INDEX "failed_jobs_uuid_unique" on "failed_jobs"("uuid");
CREATE TABLE IF NOT EXISTS "posts"(
  "id" integer primary key autoincrement not null,
  "title" varchar not null,
  "content" text not null,
  "user_id" integer not null,
  "store_id" integer,
  "created_at" datetime,
  "updated_at" datetime,
  "deleted_at" datetime,
  "is_solved" tinyint(1) not null default '0',
  foreign key("user_id") references "users"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "reviews"(
  "id" integer primary key autoincrement not null,
  "user_id" integer not null,
  "post_id" integer not null,
  "rating" integer not null,
  "comment" text not null,
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("user_id") references "users"("id") on delete cascade,
  foreign key("post_id") references "posts"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "answers"(
  "id" integer primary key autoincrement not null,
  "user_id" integer not null,
  "post_id" integer not null,
  "comment" text not null,
  "created_at" datetime,
  "updated_at" datetime,
  "is_best" tinyint(1) not null default '0',
  foreign key("user_id") references "users"("id") on delete cascade,
  foreign key("post_id") references "posts"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "bookmarks"(
  "id" integer primary key autoincrement not null,
  "user_id" integer not null,
  "post_id" integer not null,
  "store_id" integer,
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("user_id") references "users"("id") on delete cascade,
  foreign key("post_id") references "posts"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "replies"(
  "id" integer primary key autoincrement not null,
  "answer_id" integer not null,
  "user_id" integer not null,
  "content" text not null,
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("answer_id") references "answers"("id") on delete cascade,
  foreign key("user_id") references "users"("id") on delete cascade
);

INSERT INTO migrations VALUES(12,'0001_01_01_000000_create_users_table',1);
INSERT INTO migrations VALUES(13,'0001_01_01_000001_create_cache_table',1);
INSERT INTO migrations VALUES(14,'0001_01_01_000002_create_jobs_table',1);
INSERT INTO migrations VALUES(15,'2025_07_19_045434_create_posts_table',1);
INSERT INTO migrations VALUES(16,'2025_07_19_051932_create_reviews_table',1);
INSERT INTO migrations VALUES(17,'2025_07_19_052043_create_answers_table',1);
INSERT INTO migrations VALUES(18,'2025_07_19_052224_create_likes_table',1);
INSERT INTO migrations VALUES(19,'2025_07_19_080150_create_bookmarks_table',2);
INSERT INTO migrations VALUES(20,'2025_07_19_080413_drop_likes_table',3);
INSERT INTO migrations VALUES(21,'2025_07_19_095258_add_is_best_to_answers_table',4);
INSERT INTO migrations VALUES(22,'2025_07_19_103112_create_replies_table',5);
INSERT INTO migrations VALUES(23,'2025_07_20_014938_remove_rating_from_answers_table',6);
INSERT INTO migrations VALUES(24,'2025_07_20_024155_add_is_best_to_answers_table',7);
INSERT INTO migrations VALUES(25,'2025_07_20_030505_add_is_solved_to_posts_table',7);
