# Full System and Database Analysis

## 1) System Overview

This repository is a **CodeIgniter 3** MVC application that started as an admin/user-management panel and was expanded into a journal management platform.

- The app bootstraps with `login` as the default controller and has route groups for:
  - Auth + admin (`login`, `user`, `roles`, `task`, `booking`)
  - Public journal pages (`journal/*`)
  - Author module (`author/*`)
  - Placeholder reviewer/editor/admin journal-management modules (`reviewer/*`, `editor/*`, `admin/issues/*`).
- Core access control and role helpers are centralized in `BaseController`, including role constants for Admin, editorial roles, reviewer, and author.
- The app mixes:
  - mature legacy admin features (users/roles/task/booking/login history)
  - in-progress scholarly publishing features (manuscript submission, issues, publications).

## 2) Application Architecture

### 2.1 Routing and Entry Points

`application/config/routes.php` maps:

- `default_controller = login`
- `404_override = error_404`
- Public journal endpoints: home, about, aims/scope, issue/article views, search, guidelines, contact
- Author endpoints: dashboard + multi-step manuscript submission
- Reviewer/editor/admin issue routes are declared but several target controllers not present in repo.

### 2.2 Controllers and Responsibilities

- `Login` handles authentication, password-reset flow, session establishment, and role-based post-login redirects.
- `User`, `Roles`, `Task`, `Booking` manage classic admin operations.
- `Journal` is intentionally public (`CI_Controller`, not `BaseController`) and serves public-facing pages/search/contact.
- `author/Dashboard` and `author/Manuscript` enforce authenticated author/admin access and operate submission workflows.

### 2.3 Data Access Layer

Models are mostly table-centric:

- Legacy/admin: `Login_model`, `User_model`, `Role_model`, `Task_model`, `Booking_model`
- Journal domain: `Manuscript_model`, `Issue_model`, `Journal_model`, `File_model`, `Notification_model`

The app uses CodeIgniter active record/query builder, with soft-delete patterns via `isDeleted` on most business tables.

## 3) Database Analysis

Primary SQL dump: `Journal database/ajournal.sql`.

### 3.1 Schema Size and Domain Coverage

The schema defines **26 tables**, spanning:

- Identity/auth: `tbl_users`, `tbl_roles`, `tbl_access_matrix`, `tbl_last_login`, `tbl_reset_password`, `ci_sessions`
- Legacy features: `tbl_task`, `tbl_booking`
- Journal publishing lifecycle:
  - submissions/manuscripts: `tbl_manuscripts`, `tbl_manuscript_files`, `tbl_manuscript_authors`, `tbl_manuscript_author_details`, `tbl_manuscript_keywords`, `tbl_keywords`
  - peer review/editorial: `tbl_reviewer_assignments`, `tbl_review_rounds`, `tbl_revisions`, `tbl_editorial_assignments`
  - publishing/dissemination: `tbl_journal_issues`, `tbl_published_articles`, `tbl_print_orders`, `tbl_special_issues`, `tbl_special_issue_submissions`
  - activity/analytics: `tbl_notifications`, `tbl_journal_activity`, `tbl_journal_metrics`

### 3.2 Referential Integrity

The SQL includes foreign-key constraints for core relationships, including:

- manuscript linkage to users (`submittedBy`, `correspondingAuthorId`)
- manuscript child tables (`authors`, `author_details`, `files`, `keywords`) with cascades in several areas
- review/editorial assignment tables linked to users/manuscripts
- issue-publication/order relationships.

This is a strong baseline for consistency, especially in cascading manuscript teardown paths.

### 3.3 Seed Data and Role Model

Seed inserts include multi-role setup with high role IDs (e.g., editorial/reviewer/author in the teens/20s), aligning with role constants in controllers.

## 4) Code-to-Database Coverage Findings

A static scan of model/controller query-builder calls shows:

- **14 tables currently referenced in PHP code**
- **12 schema tables not currently referenced by discovered query-builder operations**

Unreferenced tables from static scan:

- `ci_sessions`
- `tbl_editorial_assignments`
- `tbl_journal_metrics`
- `tbl_keywords`
- `tbl_manuscript_keywords`
- `tbl_notifications`
- `tbl_print_orders`
- `tbl_review_rounds`
- `tbl_reviewer_assignments`
- `tbl_revisions`
- `tbl_special_issue_submissions`
- `tbl_special_issues`

> Note: `tbl_notifications` is used by `Notification_model`; static regex under-count can happen with variable table names or patterns not matching simplistic extraction.

Interpretation: the database design is ahead of implemented UI/controllers for reviewer/editor/special-issue workflows.

## 5) Gaps, Risks, and Inconsistencies

1. **Route/controller mismatch**
   - Reviewer/editor/admin issue routes exist for modules not implemented in `application/controllers/`.
   - This will produce 404/controller-not-found behavior when navigated.

2. **404 override inconsistency**
   - `404_override` points to `error_404`, but repository has `application/controllers/Error_404` file with class `Errorr_404` (double `r`) and no `.php` extension in filename.
   - This mismatch risks broken custom 404 handling.

3. **Session key inconsistency risk**
   - Some models use `session->userdata('user_id')` while login/session setup uses `userId`.
   - Audit needed for create/update attribution fields (`createdBy`, `updatedBy`) to avoid null actor metadata.

4. **Config completeness risk**
   - `application/config/database.php` is absent from tracked files, so environment setup depends on manual local provisioning.

5. **Legacy module access matrix drift**
   - `application/config/modules.php` only lists `Task` and `Booking`; newer journal modules are not represented in the same permission matrix strategy.

## 6) Overall Maturity Assessment

- **Stable:** Login/session basics, users/roles, admin CRUD foundations.
- **Partially complete:** Public journal views + author submission pathways.
- **Planned/not yet fully wired:** Reviewer/editor/admin issue-management lifecycle despite schema support and route declarations.

## 7) Recommended Next Steps (Prioritized)

1. Fix routing/controller integrity:
   - implement missing reviewer/editor/admin controllers or remove/feature-flag routes.
2. Normalize error handling:
   - rename/fix `Error_404` controller file/class to match CodeIgniter naming/route expectations.
3. Standardize session key usage (`userId` vs `user_id`) across models.
4. Add/commit environment-safe `database.php` template (`database.example.php`) and setup docs.
5. Build service-layer or workflow orchestration for review/editorial lifecycle tables already present in schema.
6. Add smoke tests for critical routes and DB-integrated happy paths (login, author submit, journal browse).

## 8) Commands Used for Analysis

- `rg --files`
- `sed -n '1,220p' README.md`
- `sed -n '1,260p' application/config/routes.php`
- `python` scripts to enumerate SQL tables, route-target/controller existence, and table usage patterns in PHP files.

