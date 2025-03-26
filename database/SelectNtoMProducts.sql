

WITH NumberedProducts AS
(
    SELECT
        productId,
        productName,
        productDescription,
        productPrice,
        GENDER,
        BRAND,
        ROW_NUMBER() OVER (ORDER BY productId) AS RowNumber
    FROM
        products
)
SELECT
    productId,
    productName,
    productDescription,
    productPrice,
    GENDER,
    BRAND
FROM
    NumberedProducts
WHERE
    RowNumber BETWEEN 10 AND 15 
    -- TEST VALUES