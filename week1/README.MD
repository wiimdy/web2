## Build

1. `docker-compose up -d`
2. connect [localhost:8080](http://localhost:8080/)

## Feat

1. Register

- 중복은 안되는지?
- sql에 회원정보가 저장되는지?

2. Login

- sql injection
- pw 검증과정

3. Board Write

- 게시판 쓰기는 로그인한 회원만 가능
- db에 동기화

4. Board Read

- 읽기는 아무나 가능 이쁘게 id, 제목, 작성자 표시
- xss가 발생하지 않도록

5. Board Delete

- 삭제는 작성자만 가능하게

6. Board Modify

- 마찬가지로 작성자만 가능, xss

## 고려사항

- DB 관리
- Docker-compose 관리
- 추가 기능

![](/src/img/read.jpg)
