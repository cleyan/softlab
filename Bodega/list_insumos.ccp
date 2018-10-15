<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\Bodega" secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" accessDeniedPage="error_nivel.ccp" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="insumosSearch" wizardCaption="Buscar Insumos " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="list_insumos.ccp" PathID="insumosSearch">
			<Components>
				<TextBox id="5" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="s_keyword" wizardCaption="Palabra clave" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" visible="Yes" PathID="insumosSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="6" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" editable="True" hasErrorCollection="True" returnValueType="Number" name="insumosPageSize" dataSource=";Seleccionar Valor;5;5;10;10;25;25;100;100" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Registro por página" wizardNoEmptyValue="True" visible="Yes" PathID="insumosSearchinsumosPageSize">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="True" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="insumosSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Record>
		<EditableGrid id="2" urlType="Relative" secured="False" emptyRows="10" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="10" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="insumos" connection="Datos" dataSource="insumos" pageSizeLimit="100" wizardCaption="Lista de Insumos " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAltRecord="False" wizardRecordSeparator="False" deleteControl="CheckBox_Delete" PathID="insumos">
			<Components>
				<Label id="8" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="insumos_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="9"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="12" visible="True" name="Sorter_cod_insumo" column="cod_insumo" wizardCaption="Cod Insumo" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="cod_insumo" PathID="insumosSorter_cod_insumo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="13" visible="True" name="Sorter_nom_insumo" column="nom_insumo" wizardCaption="Nom Insumo" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_insumo" PathID="insumosSorter_nom_insumo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="14" visible="True" name="Sorter_stock_min" column="stock_min" wizardCaption="Stock Min" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="stock_min" PathID="insumosSorter_stock_min">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="15" visible="True" name="Sorter_stock_max" column="stock_max" wizardCaption="Stock Max" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="stock_max" PathID="insumosSorter_stock_max">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="26" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="RowIDAttribute" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="27" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="RowNameAttribute" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="28" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="RowStyleAttribute" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="16" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="cod_insumo" fieldSource="cod_insumo" required="False" caption="Cod Insumo" wizardCaption="Cod Insumo" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="insumoscod_insumo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="17" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="nom_insumo" fieldSource="nom_insumo" required="False" caption="Nom Insumo" wizardCaption="Nom Insumo" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="insumosnom_insumo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="43" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="unidad_medida" wizardTheme="Inline" wizardThemeType="File" fieldSource="unidad_medida" caption="unidad medida" visible="Yes" PathID="insumosunidad_medida">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="18" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="stock_min" fieldSource="stock_min" required="False" caption="Stock Min" wizardCaption="Stock Min" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="insumosstock_min">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="19" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="stock_max" fieldSource="stock_max" required="False" caption="Stock Max" wizardCaption="Stock Max" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="insumosstock_max">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<CheckBox id="20" fieldSourceType="CodeExpression" dataType="Boolean" editable="True" name="CheckBox_Delete" checkedValue="true" uncheckedValue="false" wizardCaption="Borrar" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="True" visible="Yes" PathID="insumosCheckBox_Delete" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<Navigator id="21" type="Centered" name="Navigator" size="10" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="Inicio" wizardPrev="True" wizardPrevText="Anterior" wizardNext="True" wizardNextText="Siguiente" wizardLast="True" wizardLastText="Final" wizardImages="False" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardTheme="Inline" wizardThemeType="File" wizardImagesScheme="Inline" pageSizes="1;5;10;25;50" PathID="insumosNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Button id="25" urlType="Relative" enableValidation="False" isDefault="False" name="AddRowBtn" wizardTheme="Inline" wizardThemeType="File" PathID="insumosAddRowBtn">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="29"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="22" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Grabar" wizardTheme="Inline" wizardThemeType="File" PathID="insumosButton_Submit">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="23" message="¿Guardar los cambios?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="24" urlType="Relative" enableValidation="False" isDefault="False" name="Cancel" operation="Cancel" wizardCaption="Cancelar" wizardTheme="Inline" wizardThemeType="File" PathID="insumosCancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="30"/>
					</Actions>
				</Event>
				<Event name="BeforeExecuteDelete" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="31"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="10" conditionType="Parameter" useIsNull="False" field="cod_insumo" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="1"/>
				<TableParameter id="11" conditionType="Parameter" useIsNull="False" field="nom_insumo" parameterSource="s_keyword" dataType="Text" logicOperator="Or" searchConditionType="Contains" parameterType="URL" orderNumber="2"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<PKFields>
				<PKField id="7" tableName="insumos" fieldName="insumo_id" dataType="Integer"/>
			</PKFields>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements>
				<CustomParameter id="32" field="cod_insumo" dataType="Text" parameterType="Control" parameterSource="cod_insumo"/>
				<CustomParameter id="33" field="nom_insumo" dataType="Text" parameterType="Control" parameterSource="nom_insumo"/>
				<CustomParameter id="34" field="stock_min" dataType="Integer" parameterType="Control" parameterSource="stock_min"/>
				<CustomParameter id="35" field="stock_max" dataType="Integer" parameterType="Control" parameterSource="stock_max"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters/>
			<UConditions>
				<TableParameter id="36" conditionType="Parameter" useIsNull="False" field="insumo_id" dataType="Integer" parameterType="DataSourceColumn" parameterSource="insumo_id" searchConditionType="Equal"/>
				<TableParameter id="37" conditionType="Parameter" useIsNull="False" field="cod_insumo" dataType="Text" parameterType="URL" parameterSource="s_keyword" searchConditionType="Contains" logicOperator="Or" orderNumber="1"/>
				<TableParameter id="38" conditionType="Parameter" useIsNull="False" field="nom_insumo" dataType="Text" parameterType="URL" parameterSource="s_keyword" searchConditionType="Contains" logicOperator="Or" orderNumber="2"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="39" field="cod_insumo" dataType="Text" parameterType="Control" parameterSource="cod_insumo"/>
				<CustomParameter id="40" field="nom_insumo" dataType="Text" parameterType="Control" parameterSource="nom_insumo"/>
				<CustomParameter id="41" field="stock_min" dataType="Integer" parameterType="Control" parameterSource="stock_min"/>
				<CustomParameter id="42" field="stock_max" dataType="Integer" parameterType="Control" parameterSource="stock_max"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</EditableGrid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="list_insumos_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="list_insumos.php" comment="//" codePage="utf-8" forShow="True" url="list_insumos.php"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="44" groupID="16"/>
		<Group id="45" groupID="17"/>
		<Group id="46" groupID="18"/>
		<Group id="47" groupID="19"/>
		<Group id="48" groupID="20"/>
	</SecurityGroups>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="49"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
