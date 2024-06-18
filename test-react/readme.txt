Testing local app with React Native

Creating a new project:
npx create-expo-app --template
    Default template
    Name: app-test

Add Typescript to project:
npm install -D @tsconfig/react-native @types/jest @types/react @types/react-test-renderer typescript

Add a file config to typescript tsconfig.json
{
  "extends": "@tsconfig/react-native/tsconfig.json"
}


Typescript
Styled Component