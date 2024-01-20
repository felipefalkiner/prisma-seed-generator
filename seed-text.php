<?php

$seedBegin = "import {PrismaClient} from '@prisma/client'

const prisma = new PrismaClient()<br>
async function main() {";

$seedEnd = '}

main()
  .then(async () => {
    await prisma.$disconnect()
  })
  .catch(async (e) => {
    console.error(e)<br>
    await prisma.$disconnect()<br>
    process.exit(1)<br>
  })';

