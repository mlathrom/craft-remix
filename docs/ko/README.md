# Remix

![Remix 포스터](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-00-poster.jpg?v1)

[English](docs/en/README.md), [Deutsch](docs/de/README.md), [Schwiizerdüütsch](docs/de-CH/README.md)
[Français](docs/fr/README.md), [Français canadien](docs/fr-CA/README.md), [Norsk](docs/no/README.md), [Norsk bokmål](docs/nb/README.md), [Nederlands](docs/nl/README.md), [한국어](docs/ko/README.md), [Español](docs/es/README.md), [Русский](docs/ru/README.md)

## 개요

Remix 필드는 다음을 포함하여 정의한 규칙에 따라 제목 또는 슬러그의 변환된 값을 출력합니다:

 - 찾기 및 바꾸기 (정규식 지원)
 - 대문자, 소문자 및 제목 대소문자 변환
 - 텍스트 추가
 - 텍스트 앞에 추가

### 기능
 - **실시간 미리보기** - 규칙별 분석으로 실시간 규칙 테스트
 - **인라인 정규식 검증** - 패턴 입력 중 오류 확인
 - **정규 표현식** - 찾기 및 바꾸기용
 - **대소문자 구분 안 함** - 찾기 및 바꾸기용
 - **템플릿 규칙** - 관사 제거, 구두점 제거, 공백 축소 등 일반 패턴 빠른 추가
 - **모든 요소 유형** - 항목, 카테고리 및 제목이나 슬러그가 있는 모든 요소에서 작동
 - **요소 필터링 및 정렬** - 제어판에서

### 사용 사례
정렬, 필터링, 번역, 수정, 서식 지정, SEO

## 사용 방법
1. Remix 필드 생성
2. 대상 선택 (제목 또는 슬러그)
3. 규칙 정의 (또는 일반 패턴용 템플릿 버튼 사용)
4. 요소의 필드 레이아웃에 필드 추가
5. 요소를 저장할 때 Remix 자동 입력

## 실제 Remix 동작
![Remix 규칙 생성](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-01-create-rules.jpg?v1)
![제목 및 슬러그 변환](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-02-transform.jpg?v1)
![정렬, 필터링, SEO 등을 위해 콘텐츠 리믹스.](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-03-remix-content.jpg?v2)

## 탄생 스토리
이 필드는 정렬 필드를 만들기 위해 제목에서 "The"와 "A"를 제거하는 특정 요구사항을 해결하기 위해 만들어졌습니다. 사실, 이 플러그인의 원래 이름은 **Sort Title**이었습니다. 그러나 약간의 수정 후, 이 필드에 더 많은 잠재력이 있다는 것이 분명해졌습니다.

그렇게 Remix 필드가 탄생했습니다.

---

## v2.0.0으로 업그레이드

버전 2.0.0에는 자동 마이그레이션이 포함된 호환성 변경 사항이 있습니다:

- **속성 이름**이 PascalCase에서 camelCase로 변경됨 (예: `RemixTarget` → `target`)
- **규칙 저장 방식**이 인덱스 배열에서 연관 배열로 변경됨
- **Craft 4는 더 이상 지원되지 않음** — Craft 4의 경우 0.x 버전을 사용하세요

업데이트 시 마이그레이션이 자동으로 실행됩니다. 먼저 데이터베이스를 백업하세요.

---

## 설치

[플러그인 스토어](https://plugins.craftcms.com/remix) 또는 Composer를 통해 이 플러그인을 설치할 수 있습니다.

Craft CMS 5.0.0 이상 및 PHP 8.2 이상이 필요합니다.

### Composer를 사용하여

```bash
# 프로젝트 디렉토리로 이동
cd /path/to/my-project.test

# Composer에게 플러그인을 로드하도록 지시
composer require mlathrom/craft-remix

# Craft에게 플러그인을 설치하도록 지시
./craft plugin/install remix
```
