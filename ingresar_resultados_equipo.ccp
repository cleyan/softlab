<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" needGeneration="0" wizardTheme="InLine" wizardThemeType="File" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Record id="42" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" debugMode="False" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="peticiones_detalle_resultSearch" wizardCaption="Buscar Peticiones Detalle, Resultados, Test " wizardTheme="Inline" wizardThemeType="File" wizardOrientation="Vertical" wizardFormMethod="post" returnPage="ingresar_resultados_equipo.ccp" PathID="peticiones_detalle_resultSearch">
			<Components>
				<ListBox id="44" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="s_equipo_id" wizardCaption="Equipo Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" sourceType="Table" connection="Datos" dataSource="equipos" boundColumn="equipo_id" textColumn="nom_equipo" activeCollection="TableParameters" activeTableType="dataSource" orderBy="nom_equipo" visible="Yes" PathID="peticiones_detalle_resultSearchs_equipo_id">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="77" conditionType="Parameter" useIsNull="False" field="activo" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="'V'" parameterSource="activo" orderNumber="1"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
					<PKFields/>
				</ListBox>
				<ListBox id="45" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" editable="True" hasErrorCollection="True" returnValueType="Number" name="peticiones_detalle_resultPageSize" dataSource=";Seleccionar Valor;5;5;10;10;25;25;100;100" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Registro por página" wizardNoEmptyValue="True" visible="Yes" PathID="peticiones_detalle_resultSearchpeticiones_detalle_resultPageSize">
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
				<Button id="43" urlType="Relative" enableValidation="True" isDefault="True" name="Button_DoSearch" operation="Search" wizardTheme="Inline" wizardThemeType="File" wizardCaption="Buscar" PathID="peticiones_detalle_resultSearchButton_DoSearch">
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
		<EditableGrid id="2" urlType="Relative" secured="False" emptyRows="0" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="10" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="Datos" dataSource="peticiones_detalle, test, peticiones" name="peticiones_detalle_result" pageSizeLimit="100" wizardCaption="Lista de Peticiones Detalle, Resultados, Test " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAltRecord="False" wizardRecordSeparator="False" deleteControl="CheckBox_Delete" customInsertType="Table" activeCollection="UFormElements" customInsert="resultados" activeTableType="resultados" wizardAllowSorting="True" customUpdateType="Table" customUpdate="resultados" customDeleteType="Table" customDelete="resultados" PathID="peticiones_detalle_result">
			<Components>
				<Hidden id="446" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="linea" wizardTheme="Inline" wizardThemeType="File" PathID="peticiones_detalle_resultlinea">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="47" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="peticiones_detalle_result_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="48"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="51" visible="True" name="Sorter_muestra_id" column="peticiones_detalle.muestra_id" wizardCaption="Muestra Id" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="muestra_id" PathID="peticiones_detalle_resultSorter_muestra_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="50" visible="True" name="Sorter_test_id" column="resultados.test_id" wizardCaption="Test Id" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="test_id" PathID="peticiones_detalle_resultSorter_test_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="54" visible="True" name="Sorter_valor" column="valor" wizardCaption="Valor" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="valor" PathID="peticiones_detalle_resultSorter_valor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="57" visible="True" name="Sorter_archivo" column="archivo" wizardCaption="Archivo" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="archivo" PathID="peticiones_detalle_resultSorter_archivo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Hidden id="61" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="muestra_id" fieldSource="peticion_detalle_muestra_id" required="False" caption="Muestra Id" wizardCaption="Muestra Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="peticiones_detalle_resultmuestra_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="102" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="lb_muestra_id" wizardTheme="Inline" wizardThemeType="File" fieldSource="peticion_detalle_muestra_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="78" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_test" wizardTheme="Inline" wizardThemeType="File" fieldSource="nom_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="60" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="test_id" fieldSource="peticion_detalle_test_id" required="False" caption="Test Id" wizardCaption="Test Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="peticiones_detalle_resulttest_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="64" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="valor" fieldSource="valor" required="False" caption="Valor" wizardCaption="Valor" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="peticiones_detalle_resultvalor">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Label id="352" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="lb_list_resultados" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="63" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="estado_id" fieldSource="estado_id" required="False" caption="Estado Id" wizardCaption="Estado Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="peticiones_detalle_resultestado_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="65" fieldSourceType="DBColumn" dataType="Date" html="False" editable="True" hasErrorCollection="True" name="fecha" fieldSource="fecha" required="False" caption="Fecha" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss" PathID="peticiones_detalle_resultfecha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="67" fieldSourceType="DBColumn" dataType="Date" html="False" editable="True" hasErrorCollection="True" name="hora" fieldSource="hora" required="False" caption="Hora" wizardCaption="Hora" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" DBFormat="yyyy-mm-dd HH:nn:ss" format="H:nn:ss" PathID="peticiones_detalle_resulthora">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="70" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="ingresado_por" fieldSource="ingresado_por" required="False" caption="Ingresado Por" wizardCaption="Ingresado Por" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" defaultValue="CCGetUserID()" PathID="peticiones_detalle_resultingresado_por">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="71" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="validado_por" fieldSource="validado_por" required="False" caption="Validado Por" wizardCaption="Validado Por" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="peticiones_detalle_resultvalidado_por">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="69" fieldSourceType="DBColumn" dataType="Text" html="False" editable="True" hasErrorCollection="True" name="archivo" fieldSource="archivo" required="False" caption="Archivo" wizardCaption="Archivo" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" visible="Yes" PathID="peticiones_detalle_resultarchivo">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<CheckBox id="72" fieldSourceType="CodeExpression" dataType="Boolean" editable="True" name="CheckBox_Delete" checkedValue="true" uncheckedValue="false" wizardCaption="Borrar" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="True" visible="Yes" PathID="peticiones_detalle_resultCheckBox_Delete" defaultValue="Unchecked">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<Navigator id="73" type="Centered" name="Navigator" size="10" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="Inicio" wizardPrev="True" wizardPrevText="Anterior" wizardNext="True" wizardNextText="Siguiente" wizardLast="True" wizardLastText="Final" wizardImages="False" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardTheme="Inline" wizardThemeType="File" wizardImagesScheme="Inline" pageSizes="1;5;10;25;50" PathID="peticiones_detalle_resultNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Button id="74" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Grabar" wizardTheme="Inline" wizardThemeType="File" PathID="peticiones_detalle_resultButton_Submit">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="75" message="Enviar registro?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="76" urlType="Relative" enableValidation="False" isDefault="False" name="Cancel" operation="Cancel" wizardCaption="Cancelar" wizardTheme="Inline" wizardThemeType="File" PathID="peticiones_detalle_resultCancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="445"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="269" conditionType="Parameter" useIsNull="False" field="test.equipo_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="s_equipo_id" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="514" tableName="peticiones_detalle" posWidth="193" posHeight="228" posLeft="374" posTop="137"/>
				<JoinTable id="520" tableName="test" posWidth="150" posHeight="348" posLeft="675" posTop="280"/>
				<JoinTable id="525" tableName="peticiones" posWidth="148" posHeight="193" posLeft="677" posTop="78"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="528" fieldLeft="peticiones_detalle.test_id" fieldRight="test.test_id" tableLeft="peticiones_detalle" tableRight="test" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="529" fieldLeft="peticiones_detalle.peticion_id" fieldRight="peticiones.peticion_id" tableLeft="peticiones_detalle" tableRight="peticiones" conditionType="Equal" joinType="left"/>
			</JoinLinks>
			<Fields>
				<Field id="516" tableName="peticiones_detalle" alias="peticiones_detalle_peticion_id" fieldName="peticiones_detalle.peticion_id"/>
				<Field id="517" tableName="peticiones_detalle" alias="peticion_detalle_muestra_id" fieldName="muestra_id"/>
				<Field id="518" tableName="peticiones_detalle" alias="peticion_detalle_test_id" fieldName="peticiones_detalle.test_id"/>
				<Field id="519" tableName="peticiones_detalle" fieldName="decompuesto"/>
				<Field id="522" tableName="test" fieldName="equipo_id"/>
				<Field id="523" tableName="test" fieldName="cod_test"/>
				<Field id="524" tableName="test" fieldName="nom_test"/>
				<Field id="527" tableName="peticiones" fieldName="paciente_id"/>
			</Fields>
			<PKFields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements>
				<CustomParameter id="93" field="test_id" dataType="Integer" parameterType="Control" parameterSource="test_id"/>
				<CustomParameter id="95" field="estado_id" dataType="Integer" parameterType="Control" parameterSource="estado_id"/>
				<CustomParameter id="96" field="valor" dataType="Text" parameterType="Control" parameterSource="valor"/>
				<CustomParameter id="97" field="fecha" dataType="Date" parameterType="Control" parameterSource="fecha" DBFormat="yyyy-mm-dd HH:nn:ss" format="dd/mm/yyyy"/>
				<CustomParameter id="98" field="hora" dataType="Date" parameterType="Control" parameterSource="hora" DBFormat="yyyy-mm-dd HH:nn:ss" format="H:nn:ss"/>
				<CustomParameter id="99" field="archivo" dataType="Text" parameterType="Control" parameterSource="archivo"/>
				<CustomParameter id="100" field="ingresado_por" dataType="Integer" parameterType="Control" parameterSource="ingresado_por"/>
				<CustomParameter id="101" field="validado_por" dataType="Integer" parameterType="Control" parameterSource="validado_por"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters/>
			<UConditions>
				<TableParameter id="473" conditionType="Parameter" useIsNull="False" field="resultado_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="resultado_id"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="299" field="test_id" dataType="Integer" parameterType="Control" parameterSource="test_id"/>
				<CustomParameter id="300" field="muestra_id" dataType="Integer" parameterType="Control" parameterSource="muestra_id"/>
				<CustomParameter id="301" field="estado_id" dataType="Integer" parameterType="Control" parameterSource="estado_id"/>
				<CustomParameter id="302" field="valor" dataType="Text" parameterType="Control" parameterSource="valor"/>
				<CustomParameter id="303" field="fecha" dataType="Date" parameterType="Control" parameterSource="fecha" DBFormat="yyyy-mm-dd HH:nn:ss" format="dd/mm/yyyy"/>
				<CustomParameter id="304" field="hora" dataType="Date" parameterType="Control" parameterSource="hora" DBFormat="yyyy-mm-dd HH:nn:ss" format="H:nn:ss"/>
				<CustomParameter id="305" field="archivo" dataType="Text" parameterType="Control" parameterSource="archivo"/>
				<CustomParameter id="306" field="ingresado_por" dataType="Integer" parameterType="Control" parameterSource="ingresado_por"/>
				<CustomParameter id="307" field="validado_por" dataType="Integer" parameterType="Control" parameterSource="validado_por"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions>
				<TableParameter id="472" conditionType="Parameter" useIsNull="False" field="resultado_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="resultado_id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</EditableGrid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="ingresar_resultados_equipo_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="ingresar_resultados_equipo.php" comment="//" codePage="utf-8" forShow="True" url="ingresar_resultados_equipo.php"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="530"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
