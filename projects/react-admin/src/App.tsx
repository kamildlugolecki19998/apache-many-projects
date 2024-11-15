import {
  Admin,
  Resource,
  // ListGuesser,
  EditGuesser,
  ShowGuesser,
} from "react-admin";

import { HydraAdmin, ResourceGuesser } from '@api-platform/admin';
import { UserList } from "./Components/User/UserList";


const apiUrl = import.meta.env.VITE_API_URL;

console.log("API URL:", apiUrl);
// console.log("API URL:", apiUrl); // Wyświetli 'http://api-platform/api'
export const App = () => (
  <HydraAdmin entrypoint={apiUrl}>
    <ResourceGuesser

    name="users"
      // name="users" list={UserList}
      // list={ListGuesser}
      // edit={EditGuesser}
      // show={ShowGuesser}
    />
    <ResourceGuesser name="treasures" />
  </HydraAdmin>
);
