<?php


function add_comment(object $conn, int $authorId, int $articleId, string $body)
{
  return post_comment($conn, $authorId, $articleId, $body);
};

function add_reply(object $conn, int $authorId, int $articleId, int $commentId , string $body)
{
  return post_reply($conn, $authorId, $articleId, $commentId, $body);
};

function comment_deletion(object $conn, int $commentId)
{
  return delete_comment($conn, $commentId);
}
