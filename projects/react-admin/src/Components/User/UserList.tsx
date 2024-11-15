import { ListGuesser, FieldGuesser } from "@api-platform/admin";
import {
  List,
  ReferenceArrayField,
  ArrayField,
  Datagrid,
  TextField,
  ReferenceManyField,
  EmailField,
  SimpleList,SingleFieldList,ChipField
} from "react-admin";
import { Link } from 'react-router-dom';

export const UserList = (props) => (
  <List {...props}>
    <Datagrid>
      <EmailField source="email" />
      <TextField source="username" />
      <ArrayField label="Dragon Treasures" source="dragonTreasures"> 
      <SingleFieldList>
          <ChipField source="name" />
        </SingleFieldList>
        {/* <SimpleList primaryText={(record) => record.name}></SimpleList> */}
      </ArrayField>
    </Datagrid>
  </List>
);
