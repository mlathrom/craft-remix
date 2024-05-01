# Remix

![Remix 포스터](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-00-poster.jpg?v1)

[English](docs/en/README.md), [Deutsch](docs/de/README.md), [Schwiizerdüütsch](docs/de-CH/README.md)
[Français](docs/fr/README.md), [Français canadien](docs/fr-CA/README.md), [Norsk](docs/no/README.md), [Norsk bokmål](docs/nb/README.md), [Nederlands](docs/nl/README.md), [한국어](docs/ko/README.md), [Español](docs/es/README.md), [Русский](docs/ru/README.md)

## 개요

Remix 필드는 다음을 포함하여 정의한 규칙에 따라 제목 또는 슬러그의 변환된 값을 출력합니다:

 - 찾기 및 바꾸기
 - 대문자, 소문자 및 제목 대소문자 변환
 - 텍스트 추가
 - 텍스트 앞에 추가

### 기능
 - **실시간 새로고침** - 제목 또는 슬러그를 입력할 때
 - **정규 표현식** - 찾기 및 바꾸기용
 - **대소문자 구분 안 함** - 찾기 및 바꾸기용
 - **요소 필터링** - 제어판에서
 - **요소 정렬** - 제어판에서

### 사용 사례
정렬, 필터링, 번역, 수정, 서식 지정, SEO

## 사용 방법
1. Remix 필드 생성
2. 대상 선택 (제목 또는 슬러그)
3. 규칙 정의
4. 요소에 필드 추가
5. 요소의 제목 또는 슬러그를 추가하거나 수정할 때 Remix 자동 입력

## 실제 Remix 동작
![Remix 규칙 생성](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-01-create-rules.jpg?v1)
![제목 및 슬러그 변환](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-02-transform.jpg?v1)
![정렬, 필터링, SEO 등을 위해 콘텐츠 리믹스.](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-03-remix-content.jpg?v2)

## 탄생 스토리
이 필드는 정렬 필드를 만들기 위해 제목에서 "The"와 "A"를 제거하는 특정 요구사항을 해결하기 위해 만들어졌습니다. 사실, 이 플러그인의 원래 이름은 **Sort Title**이었습니다. 그러나 약간의 수정 후, 이 필드에 더 많은 잠재력이 있다는 것이 분명해졌습니다.

그렇게 Remix 필드가 탄생했습니다.

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
