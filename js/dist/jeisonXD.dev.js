"use strict";

function jeisonXD(JSONverificar) {
  try {
    JSON.parse(JSONverificar);
  } catch (e) {
    return false;
  }

  return true;
}