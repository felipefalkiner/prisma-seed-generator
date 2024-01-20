# PRISMA SEED GENERATOR

Simple PHP script to generate [Prisma](https://www.prisma.io/) Seed files!

Prisma Docs about Seed: https://www.prisma.io/docs/orm/prisma-migrate/workflows/seeding

- Clone this repo into a server capable of running PHP;
- Setup your current Prisma Database on database.php;
- Open index.php and the seed code will be generated, copy it;
- Paste the code into a Beatify Tool like: https://beautifier.io/
- Now save the Beautified code to your prisma folder as seed.ts
- Maybe you will need to make some adjustments because sometimes it will try to create a record of a relation that does not exist yet, try to run the seed command and if something goes wrong the terminal will warn you why it failed.
