<h2> {echo phrase="PRODUCT"} ({echo phrase="ID"}: {dbo_echo dbo="product_dbo" field="id"}) </h2>

{form name="edit_product"}
  <div class="form">
    <table style="width: 70%">
      <tr>
        <th> {form_description field="name"} </th>
        <td> {form_element dbo="product_dbo" field="name" size="20"} </td>
      </tr>
      <tr>
        <th> {form_description field="description"} </th>
        <td> {form_element dbo="product_dbo" field="description" cols="40" rows="3"} </td>
      </tr>
      <tr>
        <th> {form_description field="public"} </th>
        <td> {form_element dbo="product_dbo" field="public" option="Yes"} </td>
      </tr>
      <tr class="footer">
        <th colspan="2">
          {form_element field="save"}
          {form_element field="cancel"}
        </th>
	<td/>
      </tr>
    </table>
  </div>
{/form}

<h2> [PRICING] </h2>

{form name="edit_product_pricing"}
  <div class="table">
    {form_table field="prices" style="width: 67%"}

      {form_table_column columnid="id" header=""}
        <center> {form_table_checkbox option=$prices.id} </center>
      {/form_table_column}

      {form_table_column columnid="type" header="[TYPE]"}
        {$prices.type}
      {/form_table_column}

      {form_table_column columnid="termlength" header="[TERM_LENGTH]"}
        {if $prices.type == "Onetime"}
          [N/A]
        {else}
          {$prices.termlength} [MONTHS]
        {/if}
      {/form_table_column}

      {form_table_column columnid="price" header="[PRICE]"}
        {$prices.price|currency}
      {/form_table_column}

      {form_table_column columnid="taxable" header="[TAXABLE]"}
        {$prices.taxable}
      {/form_table_column}

      {form_table_footer}
        {form_element field="delete"}
      {/form_table_footer}

    {/form_table}
  </div>
{/form}

{form name="edit_product_add_price"}
  <div class="form">
    <table style="width: 67%">
      <tr>
        <th style="width: 25%"> {form_description field="type"} </th>
        <th style="width: 25%"> {form_description field="termlength"} </th>
        <th style="width: 25%"> {form_description field="price"} </th>
        <th style="width: 25%"> {form_description field="taxable"} </th>
      </tr>
      <tr>
        <td style="width: 25%"> {form_element field="type"} </td>
        <td style="width: 25%"> {form_element field="termlength" size="4"} </td>
        <td style="width: 25%"> {form_element field="price" size="6"} </td>
        <td style="width: 25%"> {form_element field="taxable"} </td>
      </tr>
      <tr class="footer">
        <td colspan="4"> {form_element field="add"} </td>
      </tr>
    </table>
  </div>
{/form}