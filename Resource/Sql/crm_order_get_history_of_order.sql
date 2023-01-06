 SELECT
    CONCAT(S.SET_ID, '') AS SET_ID,
    S.SET_NAME,
    S.SET_PRICE,
    S.ISSUE_DATE,
    G.GENRE_NAME,
    A.AUTHOR_NAME,
    CONCAT(
        '[',
        GROUP_CONCAT(
           '{',
           '"bookId": "',
           B.BOOK_ID,
           '" ,"bookName": "',
           B.BOOK_NAME,
           '" ,"bookIssueDate": "',
           B.ISSUE_DATE,
           '" ,"bookPrice": ',
           B.BOOK_PRICE,
           '}'
        ),
        ']'
    ) AS "BOOKS"
FROM P_ORDER O
    JOIN P_ORDER_DETAIL OD ON OD.ORDER_ID = O.ORDER_ID
    JOIN P_SET S ON S.SET_ID = OD.SET_ID
    JOIN P_SET_DETAIL SD ON SD.SET_ID = S.SET_ID
    JOIN P_BOOK B ON B.BOOK_ID = SD.BOOK_ID
    JOIN P_GENRE G ON G.GENRE_ID = B.BOOK_GENRE_ID
    JOIN P_AUTHOR A ON A.AUTHOR_ID = B.BOOK_AUTHOR_ID
WHERE O.USER_ID = :USER_ID
    AND OD.DELETE_FLAG IS FALSE
GROUP BY
    O.ORDER_ID,
    S.SET_ID,
    G.GENRE_ID,
    A.AUTHOR_ID,
    B.BOOK_TYPE,
    O.INSERTED_DATE
HAVING (B.BOOK_TYPE = :BOOK_TYPE OR COALESCE(:BOOK_TYPE, '') = '')
    AND (COALESCE(:FROM_DATE, '') = '' OR CAST(O.INSERTED_DATE AS DATE) >= :FROM_DATE)
    AND (COALESCE(:TO_DATE, '') = '' OR CAST(O.INSERTED_DATE AS DATE) <= :TO_DATE);